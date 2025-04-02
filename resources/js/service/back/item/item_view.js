import { fetchItems } from "./item_api";
import { renderItemTable } from "./item_ui.js";
import { checkAuth, handleUnauthorized } from '../../../utils/api';

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }
    
    const items = await fetchItems();
    renderItemTable(items);
});