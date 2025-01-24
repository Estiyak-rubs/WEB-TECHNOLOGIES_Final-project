function validatePassword() {
    let currentPassword = document.getElementById('currentPassword').value;
    let newPassword = document.getElementById('newPassword').value;

    if (newPassword.length < 8) {
        alert('New password must be at least 8 characters long.');
        return false;
    }

    let hasUpperCase = false;
    let hasLowerCase = false;
    let hasDigit = false;

    for (let i = 0; i < newPassword.length; i++) {
        let char = newPassword[i];
        if (char >= 'A' && char <= 'Z') {
            hasUpperCase = true;
        } else if (char >= 'a' && char <= 'z') {
            hasLowerCase = true;
        } else if (char >= '0' && char <= '9') {
            hasDigit = true;
        }
    }

    if (!(hasUpperCase && hasLowerCase && hasDigit)) {
        alert('New password must include at least one uppercase letter, one lowercase letter, and one digit.');
        return false;
    }

    return true;
}
