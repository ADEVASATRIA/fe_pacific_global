import { openEditTicketTypeModal } from './ticketType_form';
import { deleteTicketType, fetchTicketTypes } from './ticketType_api';
import { showToast } from './toast';

let selectedTicketTypeId = null;
let deleteModal;

export function renderTicketTypeTable(ticketTypes) {
  const tableBody = document.querySelector('#ticketTypeTable tbody');

  if (!tableBody) return;

  if (ticketTypes.length === 0) {
    tableBody.innerHTML = '<tr><td colspan="9" class="text-center">No ticket type found.</td></tr>';
    return;
  }

  const typeMapping = {
    1: `<span class="badge bg-label-primary">Regular</span>`,
    2: `<span class="badge bg-label-info">Member</span>`,
    3: `<span class="badge bg-label-dark">Package</span>`
  };

  tableBody.innerHTML = ticketTypes
    .map(ticketType => {
      const type_ticket =
        typeMapping[parseInt(ticketType.type_ticket, 10)] || `<span class="badge bg-label-secondary">Unknown</span>`;

      return `
            <tr>
                <td>${ticketType.id}</td>
                <td>${ticketType.clubhouse?.name ?? '<span class="text-muted">No clubhouse</span>'}</td>
                <td>${type_ticket}</td>
                <td>${ticketType.name}</td>
                <td>Rp ${ticketType.price.toLocaleString('id-ID')}</td>
                <td>${ticketType.duration} hari</td>
                <td>
                    <span class="badge bg-label-${ticketType.status == 1 ? 'primary' : 'warning'}">
                        ${ticketType.status == 1 ? 'Active' : 'Not Active'}
                    </span>
                </td>
                <td>${new Date(ticketType.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-ticket-type" href="#" data-id="${ticketType.id}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a class="dropdown-item delete-ticket-type" href="#" data-id="${ticketType.id}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            `;
    })
    .join('');
}

document.body.addEventListener('click', function (e) {
  if (e.target.closest('.edit-ticket-type')) {
    e.preventDefault();
    const ticketTypeId = e.target.closest('.edit-ticket-type').getAttribute('data-id');
    openEditTicketTypeModal(ticketTypeId);
  }

  if (e.target.closest('.delete-ticket-type')) {
    e.preventDefault();
    selectedTicketTypeId = e.target.closest('.delete-ticket-type').getAttribute('data-id');
    deleteModal.show();
  }
});

document.addEventListener('DOMContentLoaded', function () {
  deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

  confirmDeleteBtn.addEventListener('click', async function () {
    if (!selectedTicketTypeId) return;
    try {
      await deleteTicketType(selectedTicketTypeId);
      showToast('success', 'Ticket Type deleted successfully');

      const ticketTypes = await fetchTicketTypes();
      renderTicketTypeTable(ticketTypes);
    } catch (error) {
      console.error('Failed to delete Ticket Type:', error);
      showToast('danger', error.message || 'Failed to delete Ticket Type');
    } finally {
      deleteModal.hide();
    }
  });
});
