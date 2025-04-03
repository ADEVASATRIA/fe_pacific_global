import { createClubhouse, fetchClubhouseById, updateClubhouse, fetchClubhouses } from "./clubhouse_api";
import { renderClubhouseTable } from "./clubhouse_ui";
import { showToast } from "../clubhouse/toast";

let editingClubhouseId = null;

export function setupClubhouseForm() {
    const clubhouseForm = document.getElementById('clubhouseForm');
    const nameClubhouse = document.getElementById('nameClubhouse');
    const location = document.getElementById('location');
    const phone = document.getElementById('phone');
    const status = document.getElementById('status');

    if (!clubhouseForm) return;

    clubhouseForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!nameClubhouse.value || !location.value || !phone.value || !status.value) {
            showToast('danger', 'Please fill all required fields');
            return;
        }

        const submitBtn = clubhouseForm.querySelector("button[type='submit']");
        submitBtn.disabled = true;

        try {
            const clubhouseData = {
                name: nameClubhouse.value,
                location: location.value,
                phone: phone.value,
                status: status.value === '1',
            };

            if (editingClubhouseId) {
                await updateClubhouse(editingClubhouseId, clubhouseData);
                showToast('success', 'Clubhouse updated successfully!');
            } else {
                await createClubhouse(clubhouseData);
                showToast('success', 'Clubhouse created successfully!');
            }

            bootstrap.Modal.getInstance(document.getElementById('clubhouseModal')).hide();
            clubhouseForm.reset();
            editingClubhouseId = null;
            const clubhouses = await fetchClubhouses();
            renderClubhouseTable(clubhouses);
        } catch (error) {
            console.error("Failed to save clubhouse:", error);
            showToast('danger', error.message || 'Failed to save clubhouse');
        } finally {
            submitBtn.disabled = false;
        }
    });
}

export async function openEditClubhouseModal(clubhouseId) {
    try {
        const clubhouse = await fetchClubhouseById(clubhouseId);

        document.getElementById('clubhouseModalTitle').textContent = 'Edit Clubhouse';
        document.getElementById('nameClubhouse').value = clubhouse.name;
        document.getElementById('location').value = clubhouse.location;
        document.getElementById('phone').value = clubhouse.phone;
        document.getElementById('status').value = clubhouse.status ? '1' : '0';

        editingClubhouseId = clubhouseId;
        new bootstrap.Modal(document.getElementById('clubhouseModal')).show();
    } catch (error) {
        console.error("Failed to fetch clubhouse:", error);
    }
}
