import { createPackageCategory, fetchPackageCategories, fetchPackageCategoryById, updatePackageCategory } from "./package_category_api";
import { renderPackageCategoriesTable } from "./package_category_ui";
import { showToast } from "../package_category/toast";

let editingPackageCategoryId = null;

export function setupPackageCategoryForm() {
    const packageCategoryForm = document.getElementById('packageCategoryForm');
    const namePackageCategory = document.getElementById('namePackageCategory');
    const typeCategory = document.getElementById('typeCategory');
    const status = document.getElementById('status');

    if (!packageCategoryForm) return;

    packageCategoryForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        if (!namePackageCategory.value || !typeCategory.value || !status.value) {
            showToast('danger', 'Please fill all required fields');
            return;
        }
        const submitBtn = packageCategoryForm.querySelector("button[type='submit']");
        submitBtn.disabled = true;

        try {
            const packageCategoryData = {
                name: namePackageCategory.value,
                type_category: typeCategory.value,  // ✅ Betul
                status: status.value === '1',
            }
            
            if (editingPackageCategoryId) {
                await updatePackageCategory(editingPackageCategoryId, packageCategoryData);
                showToast('success', 'Package category updated successfully!');
            } else {
                await createPackageCategory(packageCategoryData);
                showToast('success', 'Package category created successfully!');
            }
            bootstrap.Modal.getInstance(document.getElementById('packageCategoryModal')).hide();
            packageCategoryForm.reset();
            editingPackageCategoryId = null;
            const packageCategories = await fetchPackageCategories();
            renderPackageCategoriesTable(packageCategories);

        } catch (error) {
            console.log("Failed to save package category:", error);
            showToast('danger', error.message || 'Failed to save package category');
        } finally {
            submitBtn.disabled = false;
        }
    });
}

export async function openEditPackageCategoryModal(packageCategoryId) {
    try {
        const packageCategory = await fetchPackageCategoryById(packageCategoryId);
        
        document.getElementById('packageCategoryModalTitle').textContent = 'Edit Package Category';
        document.getElementById('namePackageCategory').value = packageCategory.name;
        document.getElementById('typeCategory').value = packageCategory.type;
        document.getElementById('status').value = packageCategory.status ? '1' : '0';

        editingPackageCategoryId = packageCategoryId;
        new bootstrap.Modal(document.getElementById('packageCategoryModal')).show();
    } catch (error) {
        console.error("Failed to load package category:", error);
    }
}