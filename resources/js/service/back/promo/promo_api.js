import { API_ENDPOINTS } from "../../../config/api";
import { apiRequest } from "../../../utils/api";

export async function fetchPromos(){
    try {
        const data = await apiRequest(API_ENDPOINTS.PROMO);
        if (!data || !data.success) {
            throw new Error('Promos not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching promos:', error);
        redirectToErrorPage();
        return [];
    }
}

function redirectToErrorPage() {    
    window.location.href = '/error-page';
}
export async function createPromo(promoData) {
    try {
        return await apiRequest(API_ENDPOINTS.PROMO, 'POST', promoData);
    } catch (error) {
        console.error('Error creating promo:', error);
        throw error;
    }
}
export async function fetchPromoById(promoId) {
    try {
        const data = await apiRequest(`${API_ENDPOINTS.PROMO}/${promoId}`);
        if (!data || !data.success) {
            throw new Error('Promo not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching promo:', error);
        throw error;
    }
}
export async function updatePromo(promoId, promoData) {
    try {
        return await apiRequest(`${API_ENDPOINTS.PROMO}/${promoId}`, 'PUT', promoData);
    } catch (error) {
        console.error('Error updating promo:', error);
        throw error;
    }
}
export async function deletePromo(promoId) {
    try {
        return await apiRequest(`${API_ENDPOINTS.PROMO}/${promoId}`, 'DELETE');
    } catch (error) {
        console.error('Error deleting promo:', error);
        throw error;
    }
}