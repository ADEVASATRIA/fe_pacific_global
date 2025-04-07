import { openEditPackageCategoryModal } from './package_category_form';
import { deletePackageCategory, fetchPackageCategories } from './package_category_api';
import { showToast } from '../package_category/toast';

let selectedPackageCategoryId = null;
let deleteModal;

export function renderPackageCategoriesTable(packageCategories) {
  const tableBody = document.querySelector('#packageCategoryTable tbody');
  if (!tableBody) return;

  if (packageCategories.length === 0) {
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No package categories found.</td></tr>';
    return;
  }

  const typeCategoryMapping = {
    1: `<span class="badge bg-label-primary">Ticket</span>`,
    2: `<span class="badge bg-label-info">Member</span>`,
    3: `<span class="badge bg-label-dark">Items</span>`,
    4: `<span class="badge bg-label-secondary">All</span>`

  }
  tableBody.innerHTML = packageCategories
    .map(packageCategory => {
        const type_category = typeCategoryMapping[parseInt(packageCategory.type_category, 10)] || `<span class="badge bg-label-secondary">Unknown</span>`;

        return `
            <tr>
                <td>${packageCategory.id}</td>
                <td>${packageCategory.name}</td>
                <td>${type_category}</td>
                <td>${new Date(packageCategory.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>    
                <td>
                    <span class="badge bg-label-${packageCategory.status == 1 ? 'primary' : 'warning'}">
                        ${packageCategory.status == 1 ? 'Active' : 'Not Active'}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item edit-package-category" href="#" data-id="${packageCategory.id}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a class="dropdown-item delete-package-category" href="#" data-id="${packageCategory.id}">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                        </div>
                    </div>
                </td>
            </tr>
        `
    })
    .join('');

  document.querySelectorAll('.edit-package-category').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const packageCategoryId = this.getAttribute('data-id');
      openEditPackageCategoryModal(packageCategoryId);
    });
  });

  document.querySelectorAll('.delete-package-category').forEach(button => {
    button.addEventListener('click', function (e) {
        e.preventDefault();
        selectedPackageCategoryId = this.getAttribute('data-id');
        deleteModal.show();
      });
  });
}

document.addEventListener('DOMContentLoaded', async function () {
  deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

  document.body.addEventListener('click', function (e) {
    if (e.target.closest('.delete-package-category')) {
      e.preventDefault();
      selectedPackageCategoryId = e.target.closest('.delete-package-category').getAttribute('data-id');
      deleteModal.show();
    }
  });

  confirmDeleteBtn.addEventListener('click', async function () {
    if (!selectedPackageCategoryId) return;

    try {
      await deletePackageCategory(selectedPackageCategoryId);
      showToast('success', 'Package category deleted successfully!');

      const packageCategories = await fetchPackageCategories();
      renderPackageCategoriesTable(packageCategories);
    } catch (error) {
      showToast('danger', 'Failed to delete package category');
    }

    deleteModal.hide();
  });
});
