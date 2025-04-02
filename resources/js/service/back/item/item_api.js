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
        console.error('Error fetching items:', error);
        if (error.response?.status === 404) {
            redirectToErrorPage();
        }
        return [];
    }
}

function redirectToErrorPage() {
    window.location.href = '/error-page';
}