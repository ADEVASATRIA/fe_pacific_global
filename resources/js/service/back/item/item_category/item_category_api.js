import { API_ENDPOINTS } from "../../../../config/api";
import { apiRequest } from "../../../../utils/api";

export async function fetchItemCategories() {
    try {
        const data = await apiRequest(API_ENDPOINTS.ITEM_CATEGORY);
        if (!data.success) {
            throw new Error('Item categories not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching item categories:', error);
        if (error.response?.status === 404) {
            redirectToErrorPage();
        }
        return [];
    }
}

export async function createItemCategory(itemCategoryData) {
    try {
        return await apiRequest(API_ENDPOINTS.ITEM_CATEGORY, 'POST', itemCategoryData);
    } catch (error) {
        console.error('Error creating item category:', error);
        redirectToErrorPage();
        throw error;
    }
}

function redirectToErrorPage() {    
    window.location.href = '/error-page';
}

export async function fetchItemCategoryById(itemCategoryId) {
    try {
        const data = await apiRequest(`${API_ENDPOINTS.ITEM_CATEGORY}/${itemCategoryId}`);
        if (!data.success) {
            throw new Error('Item category not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching item category:', error);
        showToast('danger', 'Error fetching category details');
        throw error;
    }
}


export async function updateItemCategory(itemCategoryId, itemCategoryData) {
    try {
        return await apiRequest(`${API_ENDPOINTS.ITEM_CATEGORY}/${itemCategoryId}`, 'PUT', itemCategoryData);
    } catch (error) {
        console.error('Error updating item category:', error);
        throw error;
    }
}

export async function deleteItemCategory(itemCategoryId) {
    try {
        return await apiRequest(`${API_ENDPOINTS.ITEM_CATEGORY}/${itemCategoryId}`, 'DELETE');
    } catch (error) {
        console.error('Error deleting item category:', error);
        throw error;
    }
}