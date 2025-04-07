import { checkAuth, handleUnauthorized } from "../../../../utils/api";
import { fetchPackageCategories } from "./package_category_api";
import { renderPackageCategoriesTable } from "./package_category_ui";
import { setupPackageCategoryForm } from "./package_category_form";

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }

    setupPackageCategoryForm();
    
    try {
        const packageCategories = await fetchPackageCategories();
        renderPackageCategoriesTable(packageCategories);
    } catch (error) {
        console.error('Error loading package categories:', error);
    }
});