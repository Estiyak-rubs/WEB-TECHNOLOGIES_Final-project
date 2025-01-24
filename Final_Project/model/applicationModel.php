<?php
require_once("db.php");

function fetchFreelancerApplications($jobId) {
    $conn = getConnection();

    $query = "SELECT applications.application_id, applications.job_id, applications.freelancer_id, 
              applications.application_text, applications.application_date, applications.status,
              users.username, users.email
              FROM applications
              JOIN users ON applications.freelancer_id = users.user_id
              WHERE applications.job_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    $applications = [];

    while ($row = $result->fetch_assoc()) {
        $applications[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $applications;
}

function updateApplicationStatus($applicationId, $status) {
    try {
        $conn = getConnection();
        $validStatusValues = ["accepted", "rejected", "pending"]; 
        if (!in_array($status, $validStatusValues)) {
            throw new Exception("Invalid status value.");
        }

        $query = "UPDATE applications SET status = ? WHERE application_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $applicationId);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function checkReApply($jobId, $freelancerId) {
    $conn = getConnection();
    $query = "SELECT * FROM applications WHERE job_id = ? AND freelancer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $jobId, $freelancerId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function applyJob($jobId, $freelancerId, $applicationText) {
    
    try{
        $conn = getConnection();


        $insertQuery = "INSERT INTO applications (job_id, freelancer_id, application_text, status) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);

        $status = "pending";
        $insertStmt->bind_param("ssss", $jobId, $freelancerId, $applicationText, $status);
        $insertStmt->execute();
        return true;
    }
    catch(Exception $e){
        return false;
    }
}


function fetchStatus($jobId, $freelancerId) {
    $conn = getConnection();
    $query = "SELECT status FROM applications WHERE job_id = ? AND freelancer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $jobId, $freelancerId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['status']; // Return the status string if found
    }
    
    return "Not Applied Yet!"; // Return null if no matching row is found
}


function searchApplicationByJobID($jobID) {
    $conn = getConnection();

    $query = "SELECT * FROM jobs WHERE job_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $jobID);
    $stmt->execute();
    $result = $stmt->get_result();
    $jobs = [];
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }

    return $jobs;
}


?>

