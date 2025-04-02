import { API_ENDPOINTS } from '../../../config/api';
import { apiRequest } from '../../../utils/api';

export async function fetchRoles() {
  try {
    const data = await apiRequest(API_ENDPOINTS.ROLES);

    if (!data.success) {
      throw new Error('Roles not found');
    }

    return data.data;
  } catch (error) {
    console.error('Error fetching roles:', error);

    if (error.response?.status === 404) {
      redirectToErrorPage();
    }
    
    return [];
  }
}

export async function createRole(roleData) {
  try {
    return await apiRequest(API_ENDPOINTS.ROLES, 'POST', roleData);
  } catch (error) {
    console.error('Error creating role:', error);
    redirectToErrorPage();
    throw error;
  }
}

function redirectToErrorPage() {
  window.location.href = '/error-page';
}

export async function fetchRoleById(roleId) {
  try {
    const data = await apiRequest(`${API_ENDPOINTS.ROLES}/${roleId}`);
    if (!data.success) {
      throw new Error('Role not found');
    }
    return data.data;
  } catch (error) {
    console.error('Error fetching role:', error);
    throw error;
  }
}

export async function updateRole(roleId, roleData) {
  try {
    return await apiRequest(`${API_ENDPOINTS.ROLES}/${roleId}`, 'PUT', roleData);
  } catch (error) {
    console.error('Error updating role:', error);
    throw error;
  }
}

export async function deleteRole(roleId) {
  try {
    return await apiRequest(`${API_ENDPOINTS.ROLES}/${roleId}`, 'DELETE');
  } catch (error) {
    console.error('Error deleting role:', error);
    throw error;
  }
}
