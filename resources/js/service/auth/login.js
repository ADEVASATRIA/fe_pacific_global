import { API_ENDPOINTS } from '../../config/api';
import { apiRequest, showToast } from '../../utils/api';

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const loginButton = document.getElementById("loginButton");
    const loginButtonText = document.getElementById("loginButtonText");
    const loginButtonSpinner = document.getElementById("loginButtonSpinner");
    const loginMessage = document.getElementById("loginMessage");

    // Jika sudah login, redirect ke dashboard
    if (localStorage.getItem('jwt_token')) {
        window.location.href = "/dashboard";
        return;
    }

    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();
            
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();
            
            // Validasi input
            if (!username || !password) {
                showMessage('Please fill all fields', 'danger');
                return;
            }

            // Tampilkan loading state
            setLoadingState(true);

            try {
                const data = await apiRequest(API_ENDPOINTS.LOGIN, 'POST', {
                    username,
                    password
                });

                // Simpan token dan data user
                localStorage.setItem('jwt_token', data.token);
                localStorage.setItem('user', JSON.stringify(data.user));
                
                // Tampilkan pesan sukses
                showToast('success', 'Login successful! Redirecting...');
                
                // Redirect ke dashboard
                setTimeout(() => {
                    window.location.href = data.redirectTo || "/dashboard";
                }, 1500);
                
            } catch (error) {
                console.error('Login error:', error);
                
                // Tampilkan pesan error
                if (error.message.includes('401')) {
                    showMessage('Invalid username or password', 'danger');
                } else {
                    showMessage(error.message || 'Login failed. Please try again.', 'danger');
                }
                
            } finally {
                setLoadingState(false);
            }
        });
    }

    function showMessage(message, type) {
        if (loginMessage) {
            loginMessage.textContent = message;
            loginMessage.className = `alert alert-${type} mt-3`;
            loginMessage.style.display = 'block';
        } else {
            showToast('danger', message);
        }
    }

    function setLoadingState(isLoading) {
        if (loginButton && loginButtonText && loginButtonSpinner) {
            loginButton.disabled = isLoading;
            loginButtonText.textContent = isLoading ? "Logging in..." : "Login";
            loginButtonSpinner.classList.toggle("d-none", !isLoading);
        }
    }
});