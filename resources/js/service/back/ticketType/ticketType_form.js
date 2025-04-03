import { createTicketType, fetchTicketTypes, updateTicketType, fetchTicketTypeById } from './ticketType_api';
import { renderTicketTypeTable } from './ticketType_ui';
import { showToast } from './toast';
import { fetchClubhouses } from '../clubhouse/clubhouse_api';

let editingTicketTypeId = null;

async function populateClubhouseDropdown(selectedClubhouseId = null) {
  const clubhouseSelect = document.getElementById('clubhouseSelect');
  clubhouseSelect.innerHTML = `<option value="">Select Clubhouse</option>`;

  const clubhouses = await fetchClubhouses();
  clubhouses.forEach(clubhouse => {
    const option = document.createElement('option');
    option.value = clubhouse.id;
    option.textContent = clubhouse.name;

    if (selectedClubhouseId && clubhouse.id === selectedClubhouseId) {
      option.selected = true;
    }
    clubhouseSelect.appendChild(option);
  });
}

export function setupTicketTypeForm() {
  const ticketTypeForm = document.getElementById('ticketTypeForm');
  const clubhouseSelect = document.getElementById('clubhouseSelect');
  const typeticketSelect = document.getElementById('typeticketSelect');
  const nameTicket = document.getElementById('nameTicket');
  const price = document.getElementById('price');
  const duration = document.getElementById('duration');
  const statusTicketType = document.getElementById('statusTicketType');

  populateClubhouseDropdown();

  if (!ticketTypeForm) return;

  ticketTypeForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    if (!nameTicket.value || !price.value || !duration.value || !statusTicketType.value || !typeticketSelect.value) {
      showToast('danger', 'Please fill all required fields');
      return;
    }

    const ticketTypeData = {
      clubhouse_id: clubhouseSelect.value,
      type_ticket: typeticketSelect.value,
      name: nameTicket.value,
      price: Number(price.value),
      duration: Number(duration.value),
      status: statusTicketType.value === '1'
    };

    const submitBtn = ticketTypeForm.querySelector("button[type='submit']");
    submitBtn.disabled = true;

    try {
      if (editingTicketTypeId) {
        await updateTicketType(editingTicketTypeId, ticketTypeData);
        showToast('success', 'Ticket Type updated successfully!');
      } else {
        await createTicketType(ticketTypeData);
        showToast('success', 'Ticket Type created successfully!');
      }

      bootstrap.Modal.getInstance(document.getElementById('ticketTypeModal')).hide();
      ticketTypeForm.reset();
      editingTicketTypeId = null;
      const ticketTypes = await fetchTicketTypes();
      renderTicketTypeTable(ticketTypes);
    } catch (error) {
      console.error('❌ Gagal menyimpan Ticket Type:', error);

      if (error.response && error.response.data.errors) {
        const errorMessages = Object.values(error.response.data.errors).flat().join(', ');
        showToast('danger', `Validation Error: ${errorMessages}`);
      } else {
        showToast('danger', error.message || 'Failed to save Ticket Type');
      }
    } finally {
      submitBtn.disabled = false;
    }
  });
}

export async function openEditTicketTypeModal(ticketTypeId) {
  try {
    const ticketType = await fetchTicketTypeById(ticketTypeId);

    document.getElementById('ticketTypeModalTitle').textContent = 'Edit Ticket Type';
    document.getElementById('clubhouseSelect').value = ticketType.clubhouse_id;
    document.getElementById('typeticketSelect').value = ticketType.type_ticket;
    document.getElementById('nameTicket').value = ticketType.name;
    document.getElementById('price').value = ticketType.price;
    document.getElementById('duration').value = ticketType.duration;
    document.getElementById('statusTicketType').value = ticketType.status ? '1' : '0';

    editingTicketTypeId = ticketTypeId;
    new bootstrap.Modal(document.getElementById('ticketTypeModal')).show();
  } catch (error) {
    console.error('Failed to fetch Ticket Type:', error);
  }
}
