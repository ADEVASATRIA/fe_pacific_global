import { fetchRoles } from './role_api.js';
import { renderRoleTable } from './role_ui.js';
import { setupRoleForm } from './role_form.js';
import { checkAuth, handleUnauthorized } from '../../../utils/api';

document.addEventListener('DOMContentLoaded', async function () {
  if (!checkAuth()) {
    handleUnauthorized();
    return;
  }

  setupRoleForm();

  const roles = await fetchRoles();
  renderRoleTable(roles);
});
