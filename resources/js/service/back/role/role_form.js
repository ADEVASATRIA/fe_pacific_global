import { createRole, fetchRoles, fetchRoleById, updateRole , deleteRole } from './role_api.js';
import { renderRoleTable } from './role_ui.js';
import { showToast } from './toast.js';

let editingRoleId = null; // Menyimpan ID saat edit

export function setupRoleForm() {
  const roleForm = document.getElementById('roleForm');
  const modalTitle = document.getElementById('backDropModalTitle');
  const nameInput = document.getElementById('nameBackdrop');
  const statusInput = document.getElementById('statusBackdrop');
  const saveRoleBtnText = document.getElementById('saveRoleBtnText');

  if (!roleForm) return;

  roleForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    if (!nameInput.value || !statusInput.value) {
      showToast('danger', 'Please fill all required fields');
      return;
    }

    try {
      const roleData = {
        name: nameInput.value,
        status: statusInput.value === '1',
      };

      if (editingRoleId) {
        // Jika dalam mode edit
        await updateRole(editingRoleId, roleData);
        showToast('success', 'Role updated successfully!');
      } else {
        // Jika dalam mode create
        await createRole(roleData);
        showToast('success', 'Role created successfully!');
      }

      bootstrap.Modal.getInstance(document.getElementById('backDropModal')).hide();
      roleForm.reset();
      editingRoleId = null;

      // Fetch ulang dan render ulang tabel
      const roles = await fetchRoles();
      renderRoleTable(roles);
    } catch (error) {
      showToast('danger', error.message || 'Failed to save role');
    }
  });
}

// Fungsi untuk membuka modal dalam mode Edit
export async function openEditRoleModal(roleId) {
  try {
    const role = await fetchRoleById(roleId);

    document.getElementById('backDropModalTitle').textContent = 'Edit Role';
    document.getElementById('nameBackdrop').value = role.name;
    document.getElementById('statusBackdrop').value = role.status ? '1' : '0';
    
    editingRoleId = roleId;

    new bootstrap.Modal(document.getElementById('backDropModal')).show();
  } catch (error) {
    showToast('danger', 'Failed to fetch role data');
  }
}

// Fungsi untuk delete role
export function setupRoleActions() {
  document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
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
}
