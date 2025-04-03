import { fetchItems , createItem , fetchItemById , updateItem , deleteItem } from "./item_api";
import { renderItemTable } from "./item_ui.js";
import { showToast } from './toast.js';

import { fetchItemCategories } from "./item_category/item_category_api.js";

let editingItemId = null; 

async function populateCategoryDropdown(selectedCategoryId = null) {
    const categorySelect = document.getElementById('categorySelect');

    categorySelect.innerHTML = `<option value="">Select Category</option>`;

    const categories = await fetchItemCategories();

    categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;

        if (selectedCategoryId && category.id === selectedCategoryId) {
            option.selected = true;
        }

        categorySelect.appendChild(option);
    });
}


export function setupItemForm() {

    const itemForm = document.getElementById('itemForm');
    const categorySelect = document.getElementById('categorySelect');
    const nameItem = document.getElementById('nameItem');
    const price = document.getElementById('price');
    const stock = document.getElementById('stock');
    const statusItem = document.getElementById('statusItem'); 
    
    populateCategoryDropdown(); 

    itemForm.addEventListener('submit', async function (e) {
        e.preventDefault();
    
    
        if (!nameItem.value || !price.value || !stock.value || !statusItem.value || !categorySelect.value) {
            showToast('danger', 'Please fill all required fields');
            return;
        }
    
        try {
            const itemData = {
                categories_id: categorySelect.value, 
                name: nameItem.value,
                price: Number(price.value),          
                stock: Number(stock.value),          
                status: statusItem.value === '1',    
            };            
            
    
            if (editingItemId) {
                await updateItem(editingItemId, itemData);
                showToast('success', 'Item updated successfully!');
            } else {
                await createItem(itemData);
                showToast('success', 'Item created successfully!');
            }
    
            bootstrap.Modal.getInstance(document.getElementById('itemModal')).hide();
            itemForm.reset();
            editingItemId = null;
    
            const items = await fetchItems();
            renderItemTable(items);
        } catch (error) {
            console.error("Failed to save item:", error);
            showToast('danger', error.message || 'Failed to save item');
        }
    });
    
}



export async function openEditModal(itemId) {
    try {
        const item = await fetchItemById(itemId); 

        document.getElementById('itemModalTitle').textContent = 'Edit Item';
        document.getElementById('nameItem').value = item.name; 
        document.getElementById('price').value = item.price;
        document.getElementById('stock').value = item.stock;
        document.getElementById('statusItem').value = item.status ? "1" : "0"; 
        
        await populateCategoryDropdown(item.categories_id); 
        editingItemId = itemId; 
        new bootstrap.Modal(document.getElementById('itemModal')).show();
    } catch (error) {
        console.error("Failed to load item:", error);
    }
}


export function setupItemActions() {
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
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
}
