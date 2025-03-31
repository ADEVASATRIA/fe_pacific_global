import { API_ENDPOINTS } from '../../../config/api';

document.addEventListener("DOMContentLoaded", function () {
    fetchRoles();
});

async function fetchRoles() {
    const tableBody = document.querySelector('#roleTable tbody');
    const loadingRow = document.getElementById('loadingRow');
    
    try {
        loadingRow.style.display = '';
        
        const response = await fetch(API_ENDPOINTS.ROLES, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();

        if (data.success) {
            let rows = '';
            data.data.forEach(role => {
                let statusBadge = role.status == 1
                    ? '<span class="badge bg-label-primary me-1">Active</span>'
                    : '<span class="badge bg-label-warning me-1">Not Active</span>';

                rows += `
                    <tr>
                        <td>${role.id}</td>
                        <td>${role.name}</td>
                        <td>${new Date(role.created_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });

            loadingRow.style.display = 'none';
            tableBody.insertAdjacentHTML('beforeend', rows);
        } else {
            loadingRow.innerHTML = '<td colspan="5" class="text-center">No roles found.</td>';
        }
    } catch (error) {
        console.error('Error fetching roles:', error);
        loadingRow.innerHTML = '<td colspan="5" class="text-center text-danger">Failed to load data.</td>';
    }
}