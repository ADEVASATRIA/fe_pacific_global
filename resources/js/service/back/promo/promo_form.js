import { createPromo, fetchPromoById, updatePromo, fetchPromos } from "./promo_api";
import { renderPromoTable } from "./promo_ui";
import { showToast } from "../promo/toast";

let editingPromoId = null;

export function setupPromoForm() {
    const promoForm = document.getElementById('promoForm');
    const namePromo = document.getElementById('promoName');
    const codePromo = document.getElementById('promoCode');
    const typePromo = document.getElementById('promoType');
    const valuePromo = document.getElementById('promoValue');
    const maxDiscount = document.getElementById('promoMaxDiscount');
    const minOrderValue = document.getElementById('promoMinOrder');
    const startDate = document.getElementById('promoStartDate');
    const endDate = document.getElementById('promoEndDate');
    const status = document.getElementById('promoStatus');

    if (!promoForm) return;

    promoForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!namePromo.value || !codePromo.value || !typePromo.value || !valuePromo.value || !startDate.value || !endDate.value || !status.value) {
            showToast('danger', 'Please fill all required fields');
            return;
        }

        const submitBtn = promoForm.querySelector("button[type='submit']");
        submitBtn.disabled = true;

        try {
            const promoData = {
                name: namePromo.value,
                code: codePromo.value,
                type: typePromo.value,
                value: valuePromo.value,
                max_discount: maxDiscount.value,
                min_order_value: minOrderValue.value,
                start_date: startDate.value,
                end_date: endDate.value,
                status: status.value === '1',
            };

            if (editingPromoId) {
                await updatePromo(editingPromoId, promoData);
                showToast('success', 'Promo updated successfully!');
            } else {
                await createPromo(promoData);
                showToast('success', 'Promo created successfully!');
            }

            bootstrap.Modal.getInstance(document.getElementById('promoModal')).hide();
            promoForm.reset();
            editingPromoId = null;
            const promos = await fetchPromos();
            renderPromoTable(promos);
        } catch (error) {
            console.error("Failed to save promo:", error);
            showToast('danger', error.message || 'Failed to save promo');
        } finally {
            submitBtn.disabled = false;
        }
    });
}

export async function openEditPromoModal(promoId) {
    try {
        const promo = await fetchPromoById(promoId);

        document.getElementById('promoModalTitle').textContent = 'Edit Promo';
        document.getElementById('promoName').value = promo.name;
        document.getElementById('promoCode').value = promo.code;
        document.getElementById('promoType').value = promo.type;
        document.getElementById('promoValue').value = promo.value;
        document.getElementById('promoMaxDiscount').value = promo.max_discount || '';
        document.getElementById('promoMinOrder').value = promo.min_order_value || '';
        document.getElementById('promoStartDate').value = new Date(promo.start_date).toISOString().split('T')[0];
        document.getElementById('promoEndDate').value = new Date(promo.end_date).toISOString().split('T')[0];
        document.getElementById('promoStatus').value = promo.status ? '1' : '0';
        editingPromoId = promoId;
        new bootstrap.Modal(document.getElementById('promoModal')).show();
    } catch (error) {
        console.error("Failed to load promo for editing:", error);
    }
}