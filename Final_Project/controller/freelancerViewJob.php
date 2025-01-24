<?php
if (isset($_POST['job_id'])) {
    $jobId = $_POST['job_id'];
    require_once("../model/jobModel.php");
    $jobDetails = searchJobsByJobID($jobId);
    $jobJson = json_encode($jobDetails);
    echo $jobJson;
} else {
    echo "No job ID provided.";
}
?>
