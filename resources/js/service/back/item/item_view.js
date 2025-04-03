import { fetchItems } from "./item_api";
import { renderItemTable } from "./item_ui.js";
import { setupItemActions , setupItemForm } from "./item_form.js";
import { checkAuth, handleUnauthorized } from '../../../utils/api.js';

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }

    setupItemForm();
    setupItemActions();
    try {
        const items = await fetchItems();
        renderItemTable(items);
    } catch (error) {
        showToast('danger', 'Failed to load items');
    }
});