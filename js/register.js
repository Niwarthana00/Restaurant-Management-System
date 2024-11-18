// register.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('booking-form');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const passwordInput = document.getElementById('password');
    const rpasswordInput = document.getElementById('rpassword');
    const messageDiv = document.getElementById('message-div'); // Div to display messages

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission
        
        let isValid = true;
        const emailValue = emailInput.value.trim();
        const phoneValue = phoneInput.value.trim();
        const passwordValue = passwordInput.value.trim();
        const rpasswordValue = rpasswordInput.value.trim();

        // Clear previous errors
        clearErrors();

        // Validate email
        if (!validateEmail(emailValue)) {
            showError(emailInput, 'Invalid email format');
            isValid = false;
        }

        // Validate phone number (exactly 10 digits)
        if (!validatePhone(phoneValue)) {
            showError(phoneInput, 'Phone number must be exactly 10 digits');
            isValid = false;
        }

        // Validate password (at least 8 characters)
        if (passwordValue.length < 8) {
            showError(passwordInput, 'Password must be at least 8 characters long');
            isValid = false;
        }

        // Validate password and confirm password
        if (passwordValue !== rpasswordValue) {
            showError(rpasswordInput, 'Passwords do not match');
            isValid = false;
        }

        if (isValid) {
            // Submit form data via fetch API
            const formData = new FormData(form);
            try {
                const response = await fetch('php/register.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                
                if (result.status === 'success') {
                    messageDiv.innerHTML = `<div class="alert alert-success" role="alert">${result.message}</div>`;
                } else {
                    messageDiv.innerHTML = `<div class="alert alert-danger" role="alert">${result.message}</div>`;
                }
            } catch (error) {
                messageDiv.innerHTML = `<div class="alert alert-danger" role="alert">An error occurred. Please try again.</div>`;
            }
        }
    });

    emailInput.addEventListener('input', () => {
        // Clear the error message when the user starts typing in the email field
        clearErrors();
    });

    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    function validatePhone(phone) {
        const phonePattern = /^[0-9]{10}$/;
        return phonePattern.test(phone);
    }

    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        let error = formGroup.querySelector('.error-message');
        
        if (!error) {
            error = document.createElement('div');
            error.className = 'error-message text-danger';
            formGroup.appendChild(error);
        }
        
        error.textContent = message;
    }

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach((error) => {
            error.remove();
        });
        messageDiv.innerHTML = ''; // Clear the message div
    }
});
