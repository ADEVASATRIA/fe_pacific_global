import { API_ENDPOINTS } from '../../../config/api';
import { apiRequest } from '../../../utils/api';

export async function fetchTicketTypes() {
  try {
    const data = await apiRequest(API_ENDPOINTS.TICKETTYPE);
    if (!data || !data.success) {
      throw new Error('Ticket types not found');
    }
    return data.data;
  } catch (error) {
    console.error('Error fetching ticket types:', error);
    redirectToErrorPage();
    return [];
  }
}

function redirectToErrorPage() {
  window.location.href = '/error-page';
}

export async function createTicketType(ticketTypeData) {
  try {
    return await apiRequest(API_ENDPOINTS.TICKETTYPE, 'POST', ticketTypeData);
  } catch (error) {
    console.error('Error creating ticket type:', error);
    throw error;
  }
}

export async function fetchTicketTypeById(ticketTypeId) {
  try {
    const data = await apiRequest(`${API_ENDPOINTS.TICKETTYPE}/${ticketTypeId}`);
    if (!data || !data.success) {
      throw new Error('Ticket type not found');
    }
    return data.data;
  } catch (error) {
    console.error('Error fetching ticket type:', error);
    throw error;
  }
}

export async function updateTicketType(ticketTypeId, ticketTypeData) {
  try {
    return await apiRequest(`${API_ENDPOINTS.TICKETTYPE}/${ticketTypeId}`, 'PUT', ticketTypeData);
  } catch (error) {
    console.error('Error updating ticket type:', error);
    throw error;
  }
}

export async function deleteTicketType(ticketTypeId) {
  try {
    return await apiRequest(`${API_ENDPOINTS.TICKETTYPE}/${ticketTypeId}`, 'DELETE');
  } catch (error) {
    console.error('Error deleting ticket type:', error);
    throw error;
  }
}
