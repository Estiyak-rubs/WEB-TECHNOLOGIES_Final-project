//Showdetails:
const urlParams = new URLSearchParams(window.location.search);
const job_id = urlParams.get('job_id');
const xhr = new XMLHttpRequest();
xhr.open('POST', '../controller/freelancerViewJob.php', true);

xhr.onload = function() {
    if (xhr.status === 200) {
        const response = xhr.responseText;
        const jobDiv = document.getElementById('job'); 
        const jobDetails = JSON.parse(response)[0];
        let html = '<h3>Title:' + jobDetails.title + '</h3>';
        html += '<p>Description: ' + jobDetails.description + '</p>';
        html += '<p>Job Type: ' + jobDetails.job_type + '</p>';
        html += '<p>Payment: ' + jobDetails.payment + '</p>';
        html += '<p>Status: ' + jobDetails.status + '</p>';
        html += '<p>Post Date: ' + jobDetails.post_date + '</p>';
        jobDiv.innerHTML = html;

    }
};

const formData = new FormData();
formData.append('job_id', job_id);
xhr.send(formData);

//funcations:
