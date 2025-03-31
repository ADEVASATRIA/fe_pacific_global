import { API_ENDPOINTS } from '../../config/api';

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const loginMessage = document.getElementById("loginMessage");

        loginMessage.innerHTML = "Logging in...";

        try {
            const response = await fetch(API_ENDPOINTS.LOGIN, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ username, password })
            });

            const data = await response.json();

            if (response.ok) {
                loginMessage.innerHTML = '<span style="color: green;">Login Berhasil!</span>';
                localStorage.setItem("token", data.token); 
                window.location.href = "/dashboard"; 
            } else {
                loginMessage.innerHTML = '<span style="color: red;">' + data.message + '</span>';
            }
        } catch (error) {
            loginMessage.innerHTML = '<span style="color: red;">Server Error</span>';
        }
    });
});