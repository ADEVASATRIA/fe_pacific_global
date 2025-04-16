import { createPackage, fetchPackages,fetchPackageById, updatePackage } from './package_api';
import { fetchPackageCategories } from '../package_category/package_category_api';
import { fetchItems } from '../../item/item_api';
import { fetchTicketTypes } from '../../ticketType/ticketType_api';
import { renderPackageTable } from './package_ui';
import { showToast } from './toast';

let isFormSetup = false;
let currentPackageId = null;
let isEditMode = false;

export function renderPackageTicketItemLists(items, tickets) {
  const itemList = document.getElementById('item-list');
  const ticketList = document.getElementById('ticket-list');

  itemList.innerHTML = items
    .map(
      item => `
      <div class="list-group-item d-flex justify-content-between align-items-center" data-id="${item.id}">
        <div>
          <strong>${item.name}</strong> - ${item.description ?? ''}
        </div>
        <div class="d-flex align-items-center">
          <input type="number" class="form-control form-control-sm me-2" placeholder="Qty" style="width: 80px;" />
          <input class="form-check-input" type="checkbox" />
        </div>
      </div>
    `
    )
    .join('');

  ticketList.innerHTML = tickets
    .map(
      ticket => `
      <div class="list-group-item d-flex justify-content-between align-items-center" data-id="${ticket.id}">
        <div>
          <strong>${ticket.name}</strong> - ${ticket.description ?? ''}
        </div>
        <div class="d-flex align-items-center">
          <input type="number" class="form-control form-control-sm me-2" placeholder="Qty" style="width: 80px;" />
          <input class="form-check-input" type="checkbox" />
        </div>
      </div>
    `
    )
    .join('');
}

// Populate Dropdown
async function populateCategoryDropdown(selectedCategoryId = null) {
  const categorySelect = document.getElementById('categorySelect');
  categorySelect.innerHTML = `<option value="">Select Category</option>`;
  const categories = await fetchPackageCategories();

  categories.forEach(category => {
    const option = document.createElement('option');
    option.value = category.id;
    option.textContent = category.name;

    if (selectedCategoryId && category.id === selectedCategoryId) {
      option.selected = true;
    }

    categorySelect.appendChild(option);
  });
}

// Fungsi untuk mengisi form dengan data package yang akan di edit 
async function populateFormWithPackageData(packageId) {
  try {
    const packageData = await fetchPackageById(packageId);
    
    // Isi form fields
    document.getElementById('packageName').value = packageData.name;
    document.getElementById('price').value = packageData.price;
    document.getElementById('duration').value = packageData.duration;
    document.getElementById('statusPackage').value = packageData.status == 1 ? 'active' : 'inactive';
    
    // Isi category dropdown
    await populateCategoryDropdown(packageData.package_category_id);
    
    // Isi checkbox dan quantity untuk items dan tickets
    const tickets = await fetchTicketTypes();
    const items = await fetchItems();
    renderPackageTicketItemLists(items, tickets);
    
    // Set checkbox dan quantity berdasarkan data package
    packageData.package_details.forEach(detail => {
      let selector, qtyInput, checkbox;
      
      if (detail.ticket_type_id) {
        selector = `#ticket-list .list-group-item[data-id="${detail.ticket_type_id}"]`;
        qtyInput = document.querySelector(`${selector} input[type="number"]`);
        checkbox = document.querySelector(`${selector} input[type="checkbox"]`);
      } else if (detail.item_id) {
        selector = `#item-list .list-group-item[data-id="${detail.item_id}"]`;
        qtyInput = document.querySelector(`${selector} input[type="number"]`);
        checkbox = document.querySelector(`${selector} input[type="checkbox"]`);
      }
      
      if (qtyInput && checkbox) {
        qtyInput.value = detail.qty;
        checkbox.checked = true;
      }
    });
    
    return true;
  } catch (error) {
    console.error('Error populating form with package data:', error);
    showToast('danger', 'Failed to load package data for editing.');
    return false;
  }
}

// Setup Form (dipanggil hanya sekali)
export async function setupPackageForm() {
  const packageForm = document.getElementById('packageForm');
  const saveBtn = document.querySelector('#packageModal .btn-primary');
  const modalTitle = document.getElementById('packageModalTitle');

  await populateCategoryDropdown();

  const tickets = await fetchTicketTypes();
  const items = await fetchItems();
  renderPackageTicketItemLists(items, tickets);

  if (!isFormSetup) {
    saveBtn.addEventListener('click', async () => {
      const formData = getFormData();
      if (!formData) return;

      try {
        if (isEditMode && currentPackageId) {
          // Mode edit - update package
          const response = await updatePackage(currentPackageId, formData);
          showToast('success', 'Package updated successfully!');
        } else {
          // Mode tambah - create package
          const response = await createPackage(formData);
          showToast('success', 'Package created successfully!');
        }

        packageForm.reset();
        
        // Refresh package table
        const packages = await fetchPackages();
        renderPackageTable(packages);

        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('packageModal'));
        modal.hide();
        
        // Reset mode
        isEditMode = false;
        currentPackageId = null;
      } catch (error) {
        console.error(error);
        showToast('danger', `Failed to ${isEditMode ? 'update' : 'create'} package. Check console for details.`);
      }
    });

    isFormSetup = true;
  }
}

// Get Form Data
function getFormData() {
  const category = document.getElementById('categorySelect').value;
  const name = document.getElementById('packageName').value;
  const price = document.getElementById('price').value;
  const duration = document.getElementById('duration').value;
  const status = document.getElementById('statusPackage').value;

  if (!category || !name || !price || !duration) {
    showToast('warning', 'Please complete all required fields.');
    return null;
  }

  const tickets = document.querySelectorAll('#ticket-list .list-group-item');
  const items = document.querySelectorAll('#item-list .list-group-item');

  const selectedItems = [];

  tickets.forEach((el, i) => {
    const checkbox = el.querySelector('input[type="checkbox"]');
    const qtyInput = el.querySelector('input[type="number"]');
    if (checkbox.checked) {
      selectedItems.push({
        ticket_type_id: tickets[i].dataset.id,
        qty: parseInt(qtyInput.value)
      });
    }
  });

  items.forEach((el, i) => {
    const checkbox = el.querySelector('input[type="checkbox"]');
    const qtyInput = el.querySelector('input[type="number"]');
    if (checkbox.checked) {
      selectedItems.push({
        item_id: items[i].dataset.id,
        qty: parseInt(qtyInput.value)
      });
    }
  });

  if (selectedItems.length === 0) {
    showToast('warning', 'Please select at least one item or ticket.');
    return null;
  }

  return {
    package_category_id: category,
    name,
    price: parseFloat(price),
    duration: parseInt(duration),
    status: status === 'active' ? 1 : 0,
    items: selectedItems
  };
}

// 🧠 Setup saat modal dibuka
document.addEventListener('DOMContentLoaded', () => {
  const packageModal = document.getElementById('packageModal');

  if (packageModal) {
    packageModal.addEventListener('show.bs.modal', async () => {
      // Jika bukan mode edit, reset form
      if (!isEditMode) {
        document.getElementById('packageForm').reset();
        document.getElementById('packageModalTitle').textContent = 'Add Package Data';
        await populateCategoryDropdown();
        const tickets = await fetchTicketTypes();
        const items = await fetchItems();
        renderPackageTicketItemLists(items, tickets);
      }

      await setupPackageForm();
    });

    // Reset ke mode tambah ketika modal ditutup
    packageModal.addEventListener('hidden.bs.modal', () => {
      isEditMode = false;
      currentPackageId = null;
    });
  }
});

// Funsgi untuk setup from edit
export async function setupEditPackage(packageId) {
  isEditMode = true;
  currentPackageId = packageId;
  
  const modalTitle = document.getElementById('packageModalTitle');
  modalTitle.textContent = 'Edit Package Data';
  
  // Buka modal
  const modal = new bootstrap.Modal(document.getElementById('packageModal'));
  modal.show();
  
  // Isi form dengan data package
  await populateFormWithPackageData(packageId);
}