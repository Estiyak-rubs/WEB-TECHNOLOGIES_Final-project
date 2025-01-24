window.onload = function () {
    loadJobs();
};

function loadJobs() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../controller/clientJobsController.php', true);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            let jobs = JSON.parse(xhr.responseText);
            displayJobs(jobs);
        } else {
            console.error('Error fetching jobs:', xhr.statusText);
        }
    };

    xhr.onerror = function () {
        console.error('Network error while fetching jobs.');
    };

    xhr.send();
}


// function displayJobs(jobs) {
//     let jobListContainer = document.getElementById('jobList');
//     jobListContainer.innerHTML = '';

//     if (jobs.length === 0) {
//         jobListContainer.innerHTML = '<p>No jobs found.</p>';
//         return;
//     }
//     let ul = document.createElement('ul');
//     jobs.forEach(function (job) {
//         let li = document.createElement('li');
//         li.id = job.job_id;

//         let titleElement = document.createElement('strong');
//         titleElement.textContent = 'Job Title:';
//         li.appendChild(titleElement);
//         li.appendChild(document.createTextNode(` ${job.title}`));
//         li.appendChild(document.createElement('br'));

//         let descriptionElement = document.createElement('strong');
//         descriptionElement.textContent = 'Job Description:';
//         li.appendChild(descriptionElement);
//         li.appendChild(document.createTextNode(` ${job.description}`));
//         li.appendChild(document.createElement('br'));

//         let jobTypeElement = document.createElement('strong');
//         jobTypeElement.textContent = 'Job Type:';
//         li.appendChild(jobTypeElement);
//         li.appendChild(document.createTextNode(` ${job.job_type}`));
//         li.appendChild(document.createElement('br'));

//         let freelancerElement = document.createElement('strong');
//         freelancerElement.textContent = 'Freelancer:';
//         li.appendChild(freelancerElement);
//         li.appendChild(document.createTextNode(` ${job.freelancer_username || 'Not assigned'}`));
//         li.appendChild(document.createElement('br'));

//         let statusButton = document.createElement('button');
//         statusButton.textContent = 'Status';
//         statusButton.addEventListener('click', function () {
//             viewJobStatus(job.job_id);
//         });
//         li.appendChild(statusButton);
//         let hrElement = document.createElement('hr');
//         li.appendChild(hrElement);
//         ul.appendChild(li);
//     });

//     jobListContainer.appendChild(ul);
// }

function displayJobs(jobs) { 
    let jobListContainer = document.getElementById('jobList');
    jobListContainer.innerHTML = '';

    if (jobs.length === 0) {
        jobListContainer.innerHTML = '<p>No jobs found.</p>';
        return;
    }
    let ul = document.createElement('ul');
    jobs.forEach(function (job) {
        let li = document.createElement('li');
        li.id = job.job_id;

        let titleElement = document.createElement('strong');
        titleElement.textContent = 'Job Title:';
        li.appendChild(titleElement);
        li.appendChild(document.createTextNode(` ${job.title}`));
        li.appendChild(document.createElement('br'));

        let descriptionElement = document.createElement('strong');
        descriptionElement.textContent = 'Job Description:';
        li.appendChild(descriptionElement);
        li.appendChild(document.createTextNode(` ${job.description}`));
        li.appendChild(document.createElement('br'));

        let jobTypeElement = document.createElement('strong');
        jobTypeElement.textContent = 'Job Type:';
        li.appendChild(jobTypeElement);
        li.appendChild(document.createTextNode(` ${job.job_type}`));
        li.appendChild(document.createElement('br'));

        let freelancerElement = document.createElement('strong');
        freelancerElement.textContent = 'Freelancer:';
        li.appendChild(freelancerElement);

        let freelancers = job.freelancer_usernames 
            ? job.freelancer_usernames.split(',').map(name => name.trim()).join(', ')
            : 'Not assigned';

        li.appendChild(document.createTextNode(` ${freelancers}`));
        li.appendChild(document.createElement('br'));

        let statusButton = document.createElement('button');
        statusButton.textContent = 'Status';
        statusButton.addEventListener('click', function () {
            viewJobStatus(job.job_id);
        });
        li.appendChild(statusButton);

        let hrElement = document.createElement('hr');
        li.appendChild(hrElement);
        ul.appendChild(li);
    });

    jobListContainer.appendChild(ul);
}


function viewJobStatus(jobId) {
    window.location.href = '../view/jobView.php?job_id=' + jobId;
}





