import { fetchItemCategories } from "./item_category_api.js";
import { renderItemCategoryTable } from "./item_category_ui.js";
import { setupItemCategoryActions, setupItemCategoryForm } from "./item_category_form.js";
import { checkAuth, handleUnauthorized } from "../../../../utils/api.js";

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }
    setupItemCategoryForm();
    setupItemCategoryActions();

    try {
        const itemCategories = await fetchItemCategories();
        renderItemCategoryTable(itemCategories);
    } catch (error) {
        showToast('danger', 'Failed to load item categories');
    }
});
