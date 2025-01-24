function jobPostValidition() {
    let title = document.getElementById('title').value.trim();
    let description = document.getElementById('description').value.trim();
    let payment = document.getElementById('payment').value.trim();

    if (!title) {
        alert('Please enter a Job Title');
        return false;
    }

    if (!description) {
        alert('Please enter a Job Description');
        return false;
    }

    if (!payment) {
        alert('Please enter a Payment Amount');
        return false;
    }

    return true;
}
