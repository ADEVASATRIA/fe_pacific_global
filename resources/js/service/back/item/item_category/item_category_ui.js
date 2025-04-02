import { openEditItemCategoryModal } from "./item_category_form";
import { deleteItemCategory, fetchItemCategories } from "./item_category_api";
import { showToast } from "../toast";

let selectedItemCategoryId = null;
let deleteModal;

document.addEventListener('DOMContentLoaded', function () {
    deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    document.querySelectorAll('.delete-item-category').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            selectedItemCategoryId = this.getAttribute('data-id');
            deleteModal.show();
        });
    });

    confirmDeleteBtn.addEventListener('click', async function () {
        if (!selectedItemCategoryId) return;

        try {
            await deleteItemCategory(selectedItemCategoryId);
            showToast('success', 'Item category deleted successfully');

            const itemCategories = await fetchItemCategories();
            renderItemCategoryTable(itemCategories);
        } catch (error) {
            showToast('danger', 'Failed to delete item category');
        }

        deleteModal.hide();
    });
});


export function renderItemCategoryTable(itemCategories) {
    const tableBody = document.querySelector('#categoryTable tbody');
    if (!tableBody) return;

    if (itemCategories.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No item categories found.</td></tr>';
        return;
    }

    tableBody.innerHTML = itemCategories
        .map(itemCategory => `
            <tr>
                <td>${itemCategory.id}</td>
                <td>${itemCategory.name}</td>
                <td>${new Date(itemCategory.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
                <td>
                    <span class="badge bg-label-${itemCategory.status == 1 ? 'primary' : 'warning'}">
                        ${itemCategory.status == 1 ? 'Active' : 'Not Active'}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item edit-item-category" href="#" data-id="${itemCategory.id}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a class="dropdown-item delete-item-category" href="#" data-id="${itemCategory.id}">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                        </div>
                    </div>
                </td>
            </tr>
        `)
        .join('');

        document.querySelectorAll('.edit-item-category').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const itemCategoryId = this.getAttribute('data-id');
                openEditItemCategoryModal(itemCategoryId);
            });
        });
        

    document.querySelectorAll('.delete-item-category').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const itemCategoryId = this.getAttribute('data-id');
            selectedItemCategoryId = itemCategoryId;
            deleteModal.show();
        });
    });
}