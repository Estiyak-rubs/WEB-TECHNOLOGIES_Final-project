//Showdetails:
// const urlParams = new URLSearchParams(window.location.search);
// const job_id = urlParams.get('job_id');

let jobId  = "";
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    jobId = urlParams.get('job_id');  
});

const xhr2 = new XMLHttpRequest();
xhr2.open('POST', '../controller/applicationStatusView.php', true);

xhr2.onload = function() {
    if (xhr2.status === 200) {
        

        const response2 = xhr2.responseText;
        const jobDiv2 = document.getElementById('jobStatus'); 
        const jobDetails2 = JSON.parse(response2);
        let html2 = '<h3>Tittle:' + jobDetails2.title + '</h3>';
        html2 += '<p>Description: ' + jobDetails2.description + '</p>';
        html2 += '<p>Job Type: ' + jobDetails2.job_type + '</p>';
        html2 += '<p>Payment: ' + jobDetails2.payment + '</p>';
        html2 += '<p>Status: ' + jobDetails2.status + '</p>';
        html2 += '<p>Post Date: ' + jobDetails2.post_date + '</p>';
        jobDiv.innerHTML = html2;
    }
};

const formData2 = new FormData();
formData2.append('job_id', job_id);
xhr2.send();

//funcations:

