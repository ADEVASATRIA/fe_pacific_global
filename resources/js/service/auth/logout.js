import { API_ENDPOINTS } from "../../config/api";

document.getElementById('logout-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    try {
        const response = await fetch(API_ENDPOINTS.LOGOUT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('jwt_token')}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const data = await response.json();
        
        if (response.ok) {
            localStorage.removeItem('jwt_token');
            localStorage.removeItem('user');
            
            window.location.href = '/login';
        } else {
            alert(data.message || 'Something went wrong');
        }
    } catch (error) {
        console.error('Logout error:', error);
        alert('Failed to logout, please try again');
    }
});
