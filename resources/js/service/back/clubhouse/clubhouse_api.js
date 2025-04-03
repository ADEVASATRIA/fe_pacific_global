import { API_ENDPOINTS } from "../../../config/api";
import { apiRequest } from "../../../utils/api";

export async function fetchClubhouses() {
    try {
        const data = await apiRequest(API_ENDPOINTS.CLUBHOUSE);
        if (!data || !data.success) {
            throw new Error('Clubhouses not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching clubhouses:', error);
        redirectToErrorPage();
        return [];
    }
}

function redirectToErrorPage() {    
    window.location.href = '/error-page';
}

export async function createClubhouse(clubhouseData) {
    try {
        return await apiRequest(API_ENDPOINTS.CLUBHOUSE, 'POST', clubhouseData);
    } catch (error) {
        console.error('Error creating clubhouse:', error);
        throw error;
    }
}

export async function fetchClubhouseById(clubhouseId) {
    try {
        const data = await apiRequest(`${API_ENDPOINTS.CLUBHOUSE}/${clubhouseId}`);
        if (!data || !data.success) {
            throw new Error('Clubhouse not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching clubhouse:', error);
        throw error;
    }
}

export async function updateClubhouse(clubhouseId, clubhouseData) {
    try {
        return await apiRequest(`${API_ENDPOINTS.CLUBHOUSE}/${clubhouseId}`, 'PUT', clubhouseData);
    } catch (error) {
        console.error('Error updating clubhouse:', error);
        throw error;
    }
}

export async function deleteClubhouse(clubhouseId) {
    try {
        return await apiRequest(`${API_ENDPOINTS.CLUBHOUSE}/${clubhouseId}`, 'DELETE');
    } catch (error) {
        console.error('Error deleting clubhouse:', error);
        throw error;
    }
}
