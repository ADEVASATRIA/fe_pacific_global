export function showToast(type, message) {
    const toastContainer = document.getElementById('toastContainer') || createToastContainer();
    const toastEl = document.createElement('div');
    toastEl.className = `bs-toast toast fade show bg-${type}`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
  
    toastEl.innerHTML = `
      <div class="toast-header">
        <i class='bx bx-bell me-2'></i>
        <div class="me-auto fw-medium">Notification</div>
        <small>Just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">${message}</div>
    `;
  
    toastContainer.appendChild(toastEl);
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
  
    setTimeout(() => toastEl.remove(), 5000);
  }
  
  function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'position-fixed top-0 end-0 p-3';
    container.style.zIndex = '11';
    document.body.appendChild(container);
    return container;
  }
  