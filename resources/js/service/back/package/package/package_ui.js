import { API_ENDPOINTS } from '../../../../config/api';
import { fetchWithAuth } from '../../../../utils/api';
import { deletePackage } from './package_api';
import { showToast } from './toast';
import { setupEditPackage } from './package_form';

let packageList = [];
let selectedPackageIdToDelete = null;

document.addEventListener('DOMContentLoaded', () => {
  setupDeleteConfirmation();
  setupGlobalClickEvents();
});

async function handleViewDetails(id) {
  const container = document.getElementById('packageDetailsContent');
  if (!container) return;

  container.innerHTML = `
    <div class="d-flex justify-content-center align-items-center py-5">
      <div class="spinner-border text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  `;

  try {
    const result = await fetchWithAuth(`${API_ENDPOINTS.PACKAGE}/${id}`);
    const selectedPackage = result.data;

    if (!selectedPackage) throw new Error("Package not found.");

    const formattedPrice = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(selectedPackage.price);

    container.innerHTML = `
      <div class="package-details">
        <div class="bg-light bg-opacity-50 p-3 border-bottom bg-white">
          <div class="mb-2">
            <span class="badge bg-light text-dark border me-2">ID: ${selectedPackage.id}</span>
            <h5 class="mt-2">${selectedPackage.name}</h5>
          </div>
          <div class="row g-3 mt-1">
            <div class="col-4">
              <small class="text-muted d-block">Category</small>
              <span>${selectedPackage.package_category?.name ?? 'No Category'}</span>
            </div>
            <div class="col-4">
              <small class="text-muted d-block">Price</small>
              <span>${formattedPrice}</span>
            </div>
            <div class="col-4">
              <small class="text-muted d-block">Duration</small>
              <span>${selectedPackage.duration} Days</span>
            </div>
          </div>
        </div>
        <div class="p-3">
          <h6 class="mb-3 pb-2 border-bottom">Package Includes:</h6>
          <div class="list-group list-group-flush">
            ${selectedPackage.package_details.map(detail => `
              <div class="list-group-item px-0 py-2 bg-transparent d-flex justify-content-between align-items-center border-0 border-bottom">
                <div>${detail.name_detail_item}</div>
                <span class="badge bg-light text-dark border">${detail.qty}</span>
              </div>
            `).join('')}
          </div>
        </div>
        <div class="p-3 mt-2 text-end">
          <button class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Close</button>
        </div>
      </div>
    `;
  } catch (error) {
    console.error('Failed to fetch package details:', error);
    container.innerHTML = `
      <div class="text-center p-5">
        <i class="bi bi-exclamation-circle text-secondary fs-1"></i>
        <p class="mt-3 text-secondary">Failed to load package details.</p>
        <button class="btn btn-sm btn-outline-secondary mt-2" onclick="location.reload()">Try Again</button>
      </div>
    `;
  }
}

export function renderPackageTable(packages) {
  packageList = packages;

  const tableBody = document.querySelector('#packageTable tbody');
  if (!tableBody) return;

  if (!packages || packages.length === 0) {
    tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No packages found.</td></tr>';
    return;
  }

  tableBody.innerHTML = packages.map(pkg => `
    <tr>
      <td>${pkg.id}</td>
      <td>${pkg.package_category?.name ?? 'No Category'}</td>
      <td>${pkg.name}</td>
      <td class="text-nowrap">Rp. ${pkg.price.toLocaleString('id-ID')}</td>
      <td class="text-center">${pkg.duration} Days</td>
      <td>
        <span class="badge bg-label-${pkg.status == 1 ? 'primary' : 'warning'}">
          ${pkg.status == 1 ? 'Active' : 'Not Active'}
        </span>
      </td>
      <td>
        <button class="btn btn-info btn-sm view-details-btn" data-id="${pkg.id}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScroll">
          <i class="bx bx-detail"></i> View
        </button>
      </td>
      <td>
        <div class="dropdown">
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item edit-package" href="#" data-id="${pkg.id}">
              <i class="bx bx-edit-alt me-1"></i> Edit
            </a>
            <a class="dropdown-item delete-package" href="#" data-id="${pkg.id}">
              <i class="bx bx-trash me-1"></i> Delete
            </a>
          </div>
        </div>
      </td>
    </tr>
  `).join('');
}


function setupDeleteConfirmation() {
  const confirmBtn = document.getElementById('confirmDeleteBtn');
  if (!confirmBtn) return;

  confirmBtn.addEventListener('click', async () => {
    if (!selectedPackageIdToDelete) return;

    try {
      await deletePackage(selectedPackageIdToDelete);
      packageList = packageList.filter(pkg => pkg.id != selectedPackageIdToDelete);
      renderPackageTable(packageList);

      showToast('success', 'Package deleted successfully.');

      const modalElement = document.getElementById('deleteConfirmModal');
      const modal = bootstrap.Modal.getInstance(modalElement);
      if (modal) modal.hide();

      document.body.classList.remove('modal-open');
      const backdrop = document.querySelector('.modal-backdrop');
      if (backdrop) backdrop.remove();

      selectedPackageIdToDelete = null;
    } catch (error) {
      console.error('Failed to delete package', error);
      showToast('danger', 'Failed to delete package.');
    }
  });
}

function setupGlobalClickEvents() {
  document.addEventListener('click', async function (e) {
    const deleteBtn = e.target.closest('.delete-package');
    if (deleteBtn) {
      e.preventDefault();
      selectedPackageIdToDelete = deleteBtn.dataset.id;
      const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
      modal.show();
      return;
    }

    const viewBtn = e.target.closest('.view-details-btn');
    if (viewBtn) {
      const id = viewBtn.dataset.id;
      await handleViewDetails(id);
    }

    // Tambahkan handler untuk tombol edit
    const editBtn = e.target.closest('.edit-package');
    if (editBtn) {
      e.preventDefault();
      const packageId = editBtn.dataset.id;
      await setupEditPackage(packageId);
    }
  });
}
