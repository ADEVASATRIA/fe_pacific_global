import { showToast } from "../role/toast";

export function renderItemTable(items) {
    const tableBody = document.querySelector('#itemTable tbody');
    if (!tableBody) return;

    if (items.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center">No items found.</td></tr>';
        return;
    }

    tableBody.innerHTML = items
    .map(item => `
        <tr>
            <td>${item.id}</td>
            <td>${item.name}</td>
            <td>${item.categories?.name ?? 'No Category'}</td> <!-- Safe check -->
            <td>${item.price}</td>
            <td>${item.stock}</td>
            <td>
                <span class="badge bg-label-${item.status == 1 ? 'primary' : 'warning'}">
                    ${item.status == 1 ? 'Active' : 'Not Active'}
                </span>
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item edit-role" href="#" data-id="${item.id}">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a class="dropdown-item delete-role" href="#" data-id="${item.id}">
                        <i class="bx bx-trash me-1"></i> Delete
                    </a>
                    </div>
                </div>
            </td>
        </tr>
    `)
    .join('');
}