import { openEditModal } from "./item_form";
import { deleteItem, fetchItems } from "./item_api";

import { showToast } from "../role/toast";

let selectedItemId = null;
let deleteModal;

document.addEventListener('DOMContentLoaded', function () {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            selectedItemId = this.getAttribute('data-id');
            deleteModal.show();
        });
    });

    confirmDeleteBtn.addEventListener('click', async function () {
        if (!selectedItemId) return;
        
        try {
            await deleteItem(selectedItemId);
            showToast('success', 'Item deleted successfully');
            
            const items = await fetchItems();
            renderItemTable(items);
        } catch (error) {
            showToast('danger', 'Failed to delete item');
        }
        
        deleteModal.hide();
    });
});

export function renderItemTable(items) {
    const tableBody = document.querySelector('#itemTable tbody');
    if (!tableBody) return;

    if (!items || items.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No items found.</td></tr>';
    }
    

    tableBody.innerHTML = items
    .map(item => `
        <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.categories?.name ?? 'No Category'}</td> <!-- Safe check -->
            <td>Rp. ${item.price.toLocaleString('id-ID')}</td>
            <td>${item.stock}</td>
            <td>
                <span class="badge bg-label-${item.status == 1 ? 'primary' : 'warning'}">
                    ${item.status == 1 ? 'Active' : 'Not Active'}
                </span>
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item edit-item" href="#" data-id="${item.id}">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a class="dropdown-item delete-item" href="#" data-id="${item.id}">
                        <i class="bx bx-trash me-1"></i> Delete
                    </a>
                    </div>
                </div>
            </td>
        </tr>
    `)
    .join('');

    document.querySelectorAll('.edit-item').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const itemId = this.getAttribute('data-id');
            openEditModal(itemId); 
        });
    });

    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const itemId = this.getAttribute('data-id');
            selectedItemId = itemId;
            deleteModal.show();
        });
    });
}