import { API_ENDPOINTS } from "../../../../config/api";
import { apiRequest } from "../../../../utils/api";

export async function fetchPackages() {
    try {
        const data = await apiRequest(API_ENDPOINTS.PACKAGE);
        if (!data.success) {
            throw new Error('Packages not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error creating package:', error);
        if (error.response) {
            console.error('API Error:', error.response.data);
        }
        redirectToErrorPage();
        throw error;
    }
}

function redirectToErrorPage() {
    window.location.href = '/error-page';
}

export async function createPackage(packageData) {
    try {
        return await apiRequest(API_ENDPOINTS.PACKAGE, 'POST', packageData);
    } catch (error) {
        console.error('Error creating package:', error);
        throw error;
    }
}

export async function fetchPackageById(packageId) {
    try {
        const data = await apiRequest(`${API_ENDPOINTS.PACKAGE}/${packageId}`);
        if (!data.success) {
            throw new Error('Package not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching package:', error);
        throw error;
    }
}

export async function updatePackage(packageId, packageData) {
    try {
        return await apiRequest(`${API_ENDPOINTS.PACKAGE}/${packageId}`, 'PUT', packageData);
    } catch (error) {
        console.error('Error updating package:', error);
        throw error;
    }
}

export async function deletePackage(packageId) {
    try {
        return await apiRequest(`${API_ENDPOINTS.PACKAGE}/${packageId}`, 'DELETE');
    } catch (error) {
        console.error('Error deleting package:', error);
        throw error;
    }
}

// KHUSUS UNTUK PACKAGE ADA FETCH TICKET DAN FETCH ITEM

export async function fetchTicketTypes() {
    try {
        const data = await apiRequest(API_ENDPOINTS.TICKETTYPE);
        if (!data.success) throw new Error('Ticket types not found');
        return data.data;
    } catch (error) {
        console.error('Error fetching ticket types:', error);
        throw error;
    }
}

export async function fetchItems() {
    try {
        const data = await apiRequest(API_ENDPOINTS.ITEM);
        if (!data.success) throw new Error('Items not found');
        return data.data;
    } catch (error) {
        console.error('Error fetching items:', error);
        throw error;
    }
}
