<?php
require_once('../model/applicationModel.php');

if (isset($_GET['job_id'])) {
    $jobId = $_GET['job_id'];
    $applications = fetchFreelancerApplications($jobId);
    $resultArray = [];

    if ($applications) {
        foreach ($applications as $application) {
            $resultArray[] = [
                'application_id' => $application['application_id'],
                'freelancer_id' => $application['freelancer_id'],
                'freelancer_name' => isset($application['username']) ? $application['username'] : null,
                'freelancer_email' => $application['email'],
                'application_text' => $application['application_text'],
                'application_date' => $application['application_date'],
                'status' => $application['status'],
            ];
        }
        echo json_encode($resultArray);
    } else {
        echo "No applications found for this job.";
    }
} else {
    echo "Job ID not provided.";
}
?>
