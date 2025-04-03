import { fetchTicketTypes } from './ticketType_api';
import { renderTicketTypeTable } from './ticketType_ui';
import { checkAuth, handleUnauthorized } from '../../../utils/api';
import { setupTicketTypeForm } from './ticketType_form';

document.addEventListener('DOMContentLoaded', async function () {
  if (!checkAuth()) {
    handleUnauthorized();
    return;
  }
  setupTicketTypeForm();

  try {
    const ticketTypes = await fetchTicketTypes();
    renderTicketTypeTable(ticketTypes);
  } catch (error) {
    console.error('Error loading ticket types:', error);
  }
});
