document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("booking-form");

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        if (validateForm()) {
            form.submit(); // Submit the form if validation passes
        }
    });

    function validateForm() {
        let valid = true;

        // Validate phone number
        const phone = document.getElementById("phone").value;
        if (phone.length !== 10 || !/^\d{10}$/.test(phone)) {
            alert("Phone number must be exactly 10 digits.");
            valid = false;
        }

        // Validate password length
        const password = document.getElementById("password").value;
        if (password.length < 8) {
            alert("Password must be at least 8 characters long.");
            valid = false;
        }

        // Validate password match
        const rpassword = document.getElementById("rpassword").value;
        if (password !== rpassword) {
            alert("Passwords do not match.");
            valid = false;
        }

        return valid;
    }
});
