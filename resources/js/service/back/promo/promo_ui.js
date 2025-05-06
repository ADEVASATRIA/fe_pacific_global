import { openEditPromoModal } from "../promo/promo_form";
import { deletePromo, fetchPromos } from "./promo_api";
import { showToast } from "../promo/toast";

let selectedPromoId = null;
let deleteModal;

export function renderPromoTable(promos) {
    const tableBody = document.querySelector('#promoTable tbody');
    if (!tableBody) return;

    const rupiah = value =>
        new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 })
            .format(value);

    if (promos.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="11" class="text-center">No promo found.</td></tr>';
        return;
    }

    tableBody.innerHTML = promos
        .map(promo => {
            // Format tipe promo
            const typeLabel = promo.type == '1'
                ? `<span class="badge bg-label-primary">Percentage</span>`
                : `<span class="badge bg-label-warning">Fixed</span>`;

            // Format value
            const formattedValue = promo.type == '1'
                ? `${promo.value}%`
                : rupiah(promo.value);

            // Format max discount
            const formattedMaxDiscount = promo.max_discount != null
                ? rupiah(promo.max_discount)
                : 'Tidak ada data';

            // Format min order value
            const formattedMinOrder = promo.min_order_value != null
                ? rupiah(promo.min_order_value)
                : 'Tidak ada data';

            return `
                <tr>
                    <td>${promo.id}</td>
                    <td>${promo.name}</td>
                    <td>${promo.code}</td>
                    <td>${typeLabel}</td>
                    <td>${formattedValue}</td>
                    <td>${formattedMaxDiscount}</td>
                    <td>${formattedMinOrder}</td>
                    <td>${new Date(promo.start_date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>    
                    <td>${new Date(promo.end_date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>    
                    <td>
                        <span class="badge bg-label-${promo.status == 1 ? 'primary' : 'warning'}">
                            ${promo.status == 1 ? 'Active' : 'Not Active'}
                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item edit-promo" href="#" data-id="${promo.id}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a class="dropdown-item delete-promo" href="#" data-id="${promo.id}">
                                    <i class="bx bx-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        })
        .join('');

    document.querySelectorAll('.edit-promo').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const promoId = this.getAttribute('data-id');
            openEditPromoModal(promoId);
        });
    });

    document.querySelectorAll('.delete-promo').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            selectedPromoId = this.getAttribute('data-id');
            deleteModal.show();
        });
    });
}

document.addEventListener('DOMContentLoaded', function () {
  deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

  document.body.addEventListener('click', function (e) {
    if (e.target.closest('.delete-promo')) {
      e.preventDefault();
      selectedPromoId = e.target.closest('.delete-promo').getAttribute('data-id');
      deleteModal.show();
    }
  });

  confirmDeleteBtn.addEventListener('click', async function () {
    if (!selectedPromoId) return;

    try {
      await deletePromo(selectedPromoId);
      showToast('success', 'Promo deleted successfully');

      const promos = await fetchPromos();
      renderPromoTable(promos);
    } catch (error) {
      showToast('danger', 'Failed to delete promo');
    }

    deleteModal.hide();
  });
});
