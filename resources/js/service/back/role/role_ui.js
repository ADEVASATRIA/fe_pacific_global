import { openEditRoleModal } from './role_form.js';
import { deleteRole, fetchRoles } from './role_api.js';
import { showToast } from './toast.js';

let selectedRoleId = null;
let deleteModal;

document.addEventListener('DOMContentLoaded', function () {
  deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

  document.querySelectorAll('.delete-role').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      selectedRoleId = this.getAttribute('data-id');
      deleteModal.show();
    });
  });

  confirmDeleteBtn.addEventListener('click', async function () {
    if (!selectedRoleId) return;

    try {
      await deleteRole(selectedRoleId);
      showToast('success', 'Role deleted successfully');

      const roles = await fetchRoles();
      renderRoleTable(roles);
    } catch (error) {
      showToast('danger', 'Failed to delete role');
    }

    deleteModal.hide();
  });
});

export function renderRoleTable(roles) {
  const tableBody = document.querySelector('#roleTable tbody');
  if (!tableBody) return;

  if (roles.length === 0) {
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No roles found.</td></tr>';
    return;
  }

  tableBody.innerHTML = roles
    .map(role => `
      <tr>
        <td>${role.id}</td>
        <td>${role.name}</td>
        <td>${new Date(role.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
        <td>
          <span class="badge bg-label-${role.status == 1 ? 'primary' : 'warning'}">
            ${role.status == 1 ? 'Active' : 'Not Active'}
          </span>
        </td>
        <td>
          <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item edit-role" href="#" data-id="${role.id}">
                <i class="bx bx-edit-alt me-1"></i> Edit
              </a>
              <a class="dropdown-item delete-role" href="#" data-id="${role.id}">
                <i class="bx bx-trash me-1"></i> Delete
              </a>
            </div>
          </div>
        </td>
      </tr>
    `)
    .join('');

  document.querySelectorAll('.edit-role').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const roleId = this.getAttribute('data-id');
      openEditRoleModal(roleId);
    });
  });

  document.querySelectorAll('.delete-role').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      selectedRoleId = this.getAttribute('data-id');
      deleteModal.show();
    });
  });
}
