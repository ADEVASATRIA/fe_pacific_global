import { checkAuth, handleUnauthorized } from "../../../utils/api";
import { fetchPromos } from "./promo_api";
import { renderPromoTable } from "./promo_ui";
import { setupPromoForm } from "./promo_form";

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }

    setupPromoForm();

    try {
        const promos = await fetchPromos();
        renderPromoTable(promos);
    } catch (error) {
        console.error('Error loading promos:', error);
    }
}) 