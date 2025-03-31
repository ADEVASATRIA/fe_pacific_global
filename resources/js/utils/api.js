export async function apiRequest(url, method = 'GET', body = null) {
    const token = localStorage.getItem('jwt_token');
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    };

    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    headers['Origin'] = window.location.origin;

    const config = {
        method,
        headers,
        mode: 'cors',
        credentials: 'include',
    };

    if (body) {
        config.body = JSON.stringify(body);
    }

    try {
        const response = await fetch(url, config);
        
        if (response.status === 401) {
            handleUnauthorized();
            throw new Error('Unauthorized');
        }

        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Request failed');
        }

        return data;
    } catch (error) {
        console.error('API Request Error:', error);
        throw error;
    }
}

export function handleUnauthorized() {
    localStorage.removeItem('jwt_token');
    localStorage.removeItem('user');
    window.location.href = '/login';
}

export function checkAuth() {
    return !!localStorage.getItem('jwt_token');
}

/**
 * Fungsi untuk menampilkan toast notification
 * @param {string} type - Jenis toast (success, error, warning, info)
 * @param {string} message - Pesan yang akan ditampilkan
 * @param {number} [duration=5000] - Durasi toast dalam milidetik
 */
export function showToast(type, message, duration = 5000) {
    // Buat elemen toast
    const toastContainer = document.getElementById('toastContainer') || createToastContainer();
    const toastEl = document.createElement('div');
    
    toastEl.className = `toast show align-items-center text-white bg-${type}`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    
    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    toastContainer.appendChild(toastEl);
    
    // Auto remove setelah duration
    setTimeout(() => {
        toastEl.classList.remove('show');
        setTimeout(() => toastEl.remove(), 300);
    }, duration);
    
    // Handle close button
    toastEl.querySelector('.btn-close').addEventListener('click', () => {
        toastEl.classList.remove('show');
        setTimeout(() => toastEl.remove(), 300);
    });
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'position-fixed bottom-0 end-0 p-3';
    container.style.zIndex = '11';
    document.body.appendChild(container);
    return container;
}