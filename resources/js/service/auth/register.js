document.addEventListener("DOMContentLoaded", async function () {
    const roleSelect = document.getElementById("roleSelect");

    try {
        const response = await fetch("http://127.0.0.1:8001/api/roles", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        });

        const data = await response.json();

        if (response.ok) {
            roleSelect.innerHTML = "";
            data.data.forEach(role => {
                let option = document.createElement("option");
                option.value = role.id;
                option.textContent = role.name;
                roleSelect.appendChild(option);
            });
        } else {
            roleSelect.innerHTML = '<option selected>Error loading roles</option>';
        }
    } catch (error) {
        roleSelect.innerHTML = '<option selected>Error connecting to API</option>';
    }

    document.getElementById("registerForm").addEventListener("submit", async function (event) {
        event.preventDefault();

        const registerButton = document.getElementById("registerButton");
        registerButton.disabled = true;

        const formData = {
            role_id: document.getElementById("roleSelect").value,
            username: document.getElementById("username").value,
            name: document.getElementById("name").value,
            password: document.getElementById("password").value,
            password_confirmation: document.getElementById("password_confirmation").value,
            pin: document.getElementById("pin").value,
            pin_confirmation: document.getElementById("pin_confirmation").value,
            is_active: document.getElementById("is_active").value,
        };

        try {
            const response = await fetch("http://127.0.0.1:8001/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(formData)
            });

            const responseData = await response.json();

            if (response.ok) {
                const successToast = new bootstrap.Toast(document.getElementById("successToast"));
                successToast.show();
                setTimeout(() => {
                    window.location.href = "/login";
                }, 2000);
            } else {
                document.getElementById("failedToast").querySelector(".toast-body").textContent = responseData.message || "Registration failed.";
                const failedToast = new bootstrap.Toast(document.getElementById("failedToast"));
                failedToast.show();
            }
        } catch (error) {
            document.getElementById("failedToast").querySelector(".toast-body").textContent = "Failed to connect to API.";
            const failedToast = new bootstrap.Toast(document.getElementById("failedToast"));
            failedToast.show();
        } finally {
            registerButton.disabled = false;
        }
    });
});
