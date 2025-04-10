import { checkAuth, handleUnauthorized } from "../../../../utils/api";
import { fetchPackages, fetchItems, fetchTicketTypes } from "./package_api";
import { renderPackageTable } from "./package_ui";
import { setupPackageForm , renderPackageTicketItemLists} from "./package_form";

document.addEventListener('DOMContentLoaded', async function () {
    if (!checkAuth()) {
        handleUnauthorized();
        return;
    }

    try {
        const [packages, items, tickets] = await Promise.all([
            fetchPackages(),
            fetchItems(),
            fetchTicketTypes()
        ]);

        renderPackageTable(packages);
        renderPackageTicketItemLists(items, tickets);

        await setupPackageForm();
    } catch (error) {
        console.error('Error loading packages or related data:', error);
    }
});
