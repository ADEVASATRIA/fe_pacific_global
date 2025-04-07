import { API_ENDPOINTS } from "../../../../config/api";
import { apiRequest } from "../../../../utils/api";

export async function fetchPackageCategories() {
    try {
        const data = await apiRequest(API_ENDPOINTS.PACKAGE_CATEGORY);
        if (!data || !data.success) {
            throw new Error('Package categories not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching package categories:', error);
        redirectToErrorPage();
        return [];
    }
}

function redirectToErrorPage() {
    window.location.href = '/error-page';
}

export async function createPackageCategory(packageCategoryData) {
    try {
        return await apiRequest(API_ENDPOINTS.PACKAGE_CATEGORY, 'POST', packageCategoryData);
    } catch (error) {
        console.error('Error creating package category:', error);
        throw error;
    }
}

export async function fetchPackageCategoryById(packageCategoryId) {
    try {
        const data = await apiRequest(`${API_ENDPOINTS.PACKAGE_CATEGORY}/${packageCategoryId}`);
        if (!data || !data.success) {
            throw new Error('Package category not found');
        }
        return data.data;
    } catch (error) {
        console.error('Error fetching package category:', error);
        throw error;
    }
}

export async function updatePackageCategory(packageCategoryId, packageCategoryData) {
    try {
        return await apiRequest(`${API_ENDPOINTS.PACKAGE_CATEGORY}/${packageCategoryId}`, 'PUT', packageCategoryData);
    } catch (error) {
        console.error('Error updating package category:', error);
        throw error;
    }
}

export async function deletePackageCategory(packageCategoryId) {
    try {
        return await apiRequest(`${API_ENDPOINTS.PACKAGE_CATEGORY}/${packageCategoryId}`, 'DELETE');
    } catch (error) {
        console.error('Error deleting package category:', error);
        throw error;
    }
}