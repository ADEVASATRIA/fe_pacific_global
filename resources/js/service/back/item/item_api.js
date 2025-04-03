import { API_ENDPOINTS } from "../../../config/api";
import { apiRequest } from "../../../utils/api";

export async function fetchItems() {
    try {
        const data = await apiRequest(API_ENDPOINTS.ITEM);
        if (!data.success) {
            throw new Error('Items not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error creating item:', error);
        if (error.response) {
            console.error('API Error:', error.response.data);
        }
        redirectToErrorPage();
        throw error;
    }
}

export async function createItem(itemData) {
    try {
        return await apiRequest(API_ENDPOINTS.ITEM, 'POST', itemData);
    } catch (error) {
        console.error('Error creating item:', error);
        redirectToErrorPage();
        throw error;
    }
}

function redirectToErrorPage() {
    window.location.href = '/error-page';
}

export async function fetchItemById(itemId) {
    try {
        const data = await apiRequest(`${API_ENDPOINTS.ITEM}/${itemId}`);
        if (!data.success) {
            throw new Error('Item not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching item:', error);
        showToast('danger', 'Error fetching item details');
        throw error;
    }
}

export async function updateItem(itemId, itemData) {
    try {
        return await apiRequest(`${API_ENDPOINTS.ITEM}/${itemId}`, 'PUT', itemData);
    } catch (error) {
        console.error('Error updating item:', error);
        throw error;
    }
}
export async function deleteItem(itemId) {
    try {
        return await apiRequest(`${API_ENDPOINTS.ITEM}/${itemId}`, 'DELETE');
    } catch (error) {
        console.error('Error deleting item:', error);
        throw error;
    }
}