import { checkAuth, handleUnauthorized } from "../../../utils/api";
import { fetchClubhouses } from "./clubhouse_api";
import { renderClubhouseTable } from "./clubhouse_ui";
import { setupClubhouseForm } from "./clubhouse_form";

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }

    setupClubhouseForm();

    try {
        const clubhouses = await fetchClubhouses();
        renderClubhouseTable(clubhouses);
    } catch (error) {
        console.error('Error loading clubhouses:', error);
    }
});
