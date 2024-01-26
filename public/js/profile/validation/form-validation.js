// form-validation.js

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Validación de nombre (sin números)
        const name = form["name"];
        if (/[\d]/.test(name.value)) {
            showError(name, "Name must not contain numbers.");
            isValid = false;
        }

        // Validación de email
        const email = form["email"];
        if (!/\S+@\S+\.\S+/.test(email.value)) {
            showError(email, "Email must be a valid email address.");
            isValid = false;
        }

        // Validación de contraseña
        const password = form["password"];
        const confirmPassword = form["password_confirmation"];
        if (password.value.length < 8) {
            showError(password, "Password must be at least 8 characters.");
            isValid = false;
        } else if (password.value !== confirmPassword.value) {
            showError(confirmPassword, "Passwords must match.");
            isValid = false;
        }

        // Validación de país (sin números)
        const country = form["country"];
        if (/[\d]/.test(country.value)) {
            showError(country, "Country must not contain numbers.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        const container = input.parentElement;
        let error = container.querySelector(".error");
        if (!error) {
            error = document.createElement("div");
            error.className = "error";
            container.appendChild(error);
        }
        error.textContent = message;
    }
});
