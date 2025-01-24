<?php
session_start();
require_once("../model/applicationModel.php");
$jobId = $_SESSION['jobid'];
$freelancerId = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $application_text = $_POST['description'];
    if(!applyJob($jobId, $freelancerId, $application_text)){
        echo "<script>
                alert('Job Unavailable');
                window.location.href = '../view/freelancerDashboard.php';
              </script>";
        // header("Location: ../view/freelancerDashboard.php");
        exit();
    }
    header("Location: ../view/JobApply.php?job_id=$jobId");
    exit();
}
?>