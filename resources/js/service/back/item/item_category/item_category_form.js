import { createItemCategory, fetchItemCategories , updateItemCategory , deleteItemCategory , fetchItemCategoryById } from "./item_category_api";
import { renderItemCategoryTable } from "./item_category_ui";
import { showToast } from "../toast";
import { set } from "lodash";

let editingItemCategoryId = null; 

export function setupItemCategoryForm() {
    const itemCategoryForm = document.getElementById('itemCategoryForm');
    const nameCategory = document.getElementById('nameCategory');
    const description = document.getElementById('description');
    const status = document.getElementById('status');

    if (!itemCategoryForm) return;

    itemCategoryForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        if(!nameCategory.value || !description.value || !status.value) {
            showToast('danger', 'Please fill all required fields');
            return;
        }
        try {
            const itemCategoryData = {
                name: nameCategory.value,
                description: description.value,
                status: status.value === '1',
            };

            if (editingItemCategoryId) {
                await updateItemCategory(editingItemCategoryId, itemCategoryData);
                showToast('success', 'Item Category updated successfully!');
            } else {
                await createItemCategory(itemCategoryData);
                showToast('success', 'Item Category created successfully!');
            }

            bootstrap.Modal.getInstance(document.getElementById('itemCategoryModal')).hide();
            itemCategoryForm.reset();
            editingItemCategoryId = null;
            
            const itemCategories = await fetchItemCategories();
            renderItemCategoryTable(itemCategories);
        } catch (error) {
            showToast('danger', error.message || 'Failed to save item category');
        }
    });
}

export async function openEditItemCategoryModal(itemCategoryId) {
    try {
        console.log('masuk logic open Edit Item Category Modal');
        const itemCategory = await fetchItemCategoryById(itemCategoryId);

        document.getElementById('itemCategoryModalTitle').textContent = 'Edit Item Category';
        document.getElementById('nameCategory').value = itemCategory.name;
        document.getElementById('description').value = itemCategory.description;
        document.getElementById('status').value = itemCategory.status ? '1' : '0';

        editingItemCategoryId = itemCategoryId;
        new bootstrap.Modal(document.getElementById('itemCategoryModal')).show();
    } catch (error) {
        showToast('danger', error.message || 'Failed to fetch item category');
    }
}

export function setupItemCategoryActions() {
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
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
        
    })
}