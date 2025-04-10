import { createPackage, fetchPackages } from './package_api';
import { fetchPackageCategories } from '../package_category/package_category_api';
import { fetchItems } from '../../item/item_api';
import { fetchTicketTypes } from '../../ticketType/ticketType_api';
import { renderPackageTable } from './package_ui';
import { showToast } from './toast';

let isFormSetup = false;

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

// Setup Form (dipanggil hanya sekali)
export async function setupPackageForm() {
  const packageForm = document.getElementById('packageForm');
  const saveBtn = document.querySelector('#packageModal .btn-primary');

  await populateCategoryDropdown();

  const tickets = await fetchTicketTypes();
  const items = await fetchItems();
  renderPackageTicketItemLists(items, tickets);

  if (!isFormSetup) {
    saveBtn.addEventListener('click', async () => {
      const formData = getFormData();
      if (!formData) return;

      try {
        const response = await createPackage(formData);
        showToast('success', 'Package created successfully!');
        packageForm.reset();

        // 🔁 Refresh package table
        const packages = await fetchPackages();
        renderPackageTable(packages);

        // 🚪 Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('packageModal'));
        modal.hide();
      } catch (error) {
        console.error(error);
        showToast('danger', 'Failed to create package. Check console for details.');
      }
    });

    isFormSetup = true; // 🧠 hanya set listener sekali
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
      // Reset form dan repopulate ulang
      document.getElementById('packageForm').reset();
      await populateCategoryDropdown();
      const tickets = await fetchTicketTypes();
      const items = await fetchItems();
      renderPackageTicketItemLists(items, tickets);

      // Setup form hanya pertama kali
      await setupPackageForm();
    });
  }
});
