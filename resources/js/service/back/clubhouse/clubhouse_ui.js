import { openEditClubhouseModal } from './clubhouse_form';
import { deleteClubhouse , fetchClubhouses } from './clubhouse_api';
import { showToast } from '../clubhouse/toast';

let selectedClubhouseId = null;
let deleteModal;

export function renderClubhouseTable(clubhouses) {
  const tableBody = document.querySelector('#clubhouseTable tbody');
  if (!tableBody) return;

  if (clubhouses.length === 0) {
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No clubhouse found.</td></tr>';
    return;
  }

  tableBody.innerHTML = clubhouses
    .map(
        clubhouse => `
            <tr>
                <td>${clubhouse.id}</td>
                <td>${clubhouse.name}</td>
                <td>${clubhouse.location}</td>
                <td>${clubhouse.phone}</td>
                <td>
                    <span class="badge bg-label-${clubhouse.status == 1 ? 'primary' : 'warning'}">
                        ${clubhouse.status == 1 ? 'Active' : 'Not Active'}
                    </span>
                </td>
                <td>${new Date(clubhouse.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>    
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item edit-clubhouse" href="#" data-id="${clubhouse.id}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a class="dropdown-item delete-clubhouse" href="#" data-id="${clubhouse.id}">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                        </div>
                    </div>
                </td>
            </tr>
        `)
        .join('');

        document.querySelectorAll('.edit-clubhouse').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const clubhouseId = this.getAttribute('data-id');
                openEditClubhouseModal(clubhouseId);
            });
        });

    document.querySelectorAll('.delete-clubhouse').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            selectedClubhouseId = this.getAttribute('data-id');
            deleteModal.show();
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    document.body.addEventListener('click', function (e) {
        if (e.target.closest('.delete-clubhouse')) {
            e.preventDefault();
            selectedClubhouseId = e.target.closest('.delete-clubhouse').getAttribute('data-id');
            deleteModal.show();
        }
    });

    confirmDeleteBtn.addEventListener('click', async function () {
        if (!selectedClubhouseId) return;

        try {
            await deleteClubhouse(selectedClubhouseId);
            showToast('success', 'Clubhouse deleted successfully');

            const clubhouses = await fetchClubhouses();
            renderClubhouseTable(clubhouses);
        } catch (error) {
            showToast('danger', 'Failed to delete clubhouse');
        }

        deleteModal.hide();
    });
});

