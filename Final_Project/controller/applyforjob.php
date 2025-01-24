<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../model/db.php'); 
$conn = getConnection();

$jobId = $_POST['jobId'];
$applicantName = $_POST['applicantName'];
$applicantEmail = $_POST['applicantEmail'];
$applicationText = $_POST['applicationText'];

$sql = "INSERT INTO applications (job_id, freelancer_id, application_text) VALUES ($jobId, null, '$applicationText')";

if ($conn->query($sql) === true) {
    echo "Application submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
