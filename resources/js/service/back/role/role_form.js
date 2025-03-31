import { createRole, fetchRoles } from './role_api.js';
import { renderRoleTable } from './role_ui.js';
import { showToast } from './toast.js';

export function setupRoleForm() {
  const roleForm = document.getElementById('roleForm');
  if (!roleForm) return;

  roleForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    const nameInput = document.getElementById('nameBackdrop');
    const statusInput = document.getElementById('statusBackdrop');

    if (!nameInput.value || !statusInput.value) {
      showToast('danger', 'Please fill all required fields');
      return;
    }

    try {
      const roleData = {
        name: nameInput.value,
        status: statusInput.value === '1',
      };

      await createRole(roleData);

      bootstrap.Modal.getInstance(document.getElementById('backDropModal')).hide();
      roleForm.reset();

      const roles = await fetchRoles();
      renderRoleTable(roles);

      showToast('success', 'Role created successfully!');
    } catch (error) {
      showToast('danger', error.message || 'Failed to create role');
    }
  });
}
