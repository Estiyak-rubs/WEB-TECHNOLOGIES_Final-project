function validateSignUpForm() {
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let repassword = document.getElementById('repassword').value;
    let userType = document.getElementById('user_type').value;

    let isValid = true; 
    
    document.getElementById('passerror').innerText = '';
    document.getElementById('repasserror').innerText = '';
    document.getElementById('emailerror').innerText = '';

    if (password.length < 8) {
        document.getElementById('passerror').innerText = 'Password must be at least 8 characters long.';
        document.getElementById('passerror').style.color = 'red'; 
        isValid = false;
    }

    let hasUpperCase = false;
    let hasLowerCase = false;
    let hasDigit = false;

    for (let i = 0; i < password.length; i++) {
        let char = password[i];
        if (char >= 'A' && char <= 'Z') {
            hasUpperCase = true;
        } else if (char >= 'a' && char <= 'z') {
            hasLowerCase = true;
        } else if (char >= '0' && char <= '9') {
            hasDigit = true;
        }
    }

    if (!(hasUpperCase && hasLowerCase && hasDigit)) {
        document.getElementById('passerror').innerText = 'Password must include at least one uppercase letter, one lowercase letter, and one digit.';
        document.getElementById('passerror').style.color = 'red'; 
        isValid = false;
    }

    if (password !== repassword) {
        document.getElementById('repasserror').innerText = 'Passwords do not match.';
        document.getElementById('repasserror').style.color = 'red'; 
        isValid = false;
    }

    return isValid;
}
