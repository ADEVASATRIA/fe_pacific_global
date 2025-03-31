import { API_ENDPOINTS } from '../../../config/api';
import { apiRequest } from '../../../utils/api';

export async function fetchRoles() {
  try {
    const data = await apiRequest(API_ENDPOINTS.ROLES);
    return data.success ? data.data : [];
  } catch (error) {
    console.error('Error fetching roles:', error);
    return [];
  }
}

export async function createRole(roleData) {
  try {
    return await apiRequest(API_ENDPOINTS.ROLES, 'POST', roleData);
  } catch (error) {
    console.error('Error creating role:', error);
    throw error;
  }
}
