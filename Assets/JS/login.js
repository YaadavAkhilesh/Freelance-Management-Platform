// Onsubmit Check Username ( !empty ) + Password validation
document.getElementById('loginForm').addEventListener('submit', function(event) {
    // Initialize a flag to track if there are any errors
    let hasErrors = false;

    let userName = document.getElementById('userName').value;
    let password = document.getElementById('password').value;
    
    let passwordError = document.getElementById('password-error');
    let userNameError = document.getElementById('username-error');
    
    // Clear previous error messages
    userNameError.textContent = '';
    passwordError.textContent = '';

    // Validate username
    if (userName === '') {
        userNameError.style.color = '#ff6a31';
        userNameError.textContent = 'Please enter your username';
        hasErrors = true; // Set the error flag
    }

    // Validate password
    if (password === '') {
        passwordError.style.color = '#ff6a31';
        passwordError.textContent = 'Please enter your password.';
        hasErrors = true; // Set the error flag
    } else if (password.length < 8) {
        passwordError.style.color = '#ff6a31';
        passwordError.textContent = 'Password must be at least 8 characters long.';
        hasErrors = true; // Set the error flag
    } else if (password.length > 18) {
        passwordError.style.color = '#ff6a31';
        passwordError.textContent = 'Password must be no longer than 18 characters.';
        hasErrors = true; // Set the error flag
    }

    // If there are errors, prevent form submission
    if (hasErrors) {
        event.preventDefault(); // Prevent form submission
    } else {
        // If there are no errors, allow the form to submit
        // No need to call this.submit() as the form will submit normally
    }
});

// Fill Time checking Password
document.getElementById('password').addEventListener('input', function() {
    let password = this.value;
    let passwordError = document.getElementById('password-error');
    
    // Clear previous error message
    passwordError.textContent = '';

    // Validate password on input
    if (password === '') {
        passwordError.style.color = '#ff6a31';
        passwordError.textContent = 'Please enter your password.';
    } else if (password.length < 8) {
        passwordError.style.color = '#ff6a31';
        passwordError.textContent = 'Password must be at least 8 characters long';
    } else if (password.length > 18) {
        passwordError.style.color = '#ff6a31';
        passwordError.textContent = 'Password must be no longer than 18 characters';
    }
});


// Password Show/Hide functionality
function togglePasswordVisibility(passwordInputId, eyeOpenIconId, eyeCloseIconId) {
    const passwordInput = document.getElementById(passwordInputId);
    const eyeOpenIcon = document.getElementById(eyeOpenIconId);
    const eyeCloseIcon = document.getElementById(eyeCloseIconId);

    if (passwordInput.getAttribute('type') === 'password') {
        passwordInput.setAttribute('type', 'text');
        eyeOpenIcon.style.display = 'block';
        eyeCloseIcon.style.display = 'none';
    } else {
        passwordInput.setAttribute('type', 'password');
        eyeOpenIcon.style.display = 'none';
        eyeCloseIcon.style.display = 'block';
    }
}

// Event listeners for password visibility toggles
document.getElementById('toggle-password-icon').addEventListener('click', () => {
    togglePasswordVisibility('password', 'eye-open-icon', 'eye-close-icon');
});