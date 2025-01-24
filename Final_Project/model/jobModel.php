<?php
require_once('db.php');

function postJob($client_id, $title, $description, $job_type, $payment) {
    $conn = getConnection();
    $response = ['success' => false, 'message' => ''];

    if ($conn->connect_error) {
        $response['message'] = "Connection failed: " . $conn->connect_error;
        return $response;
    }

    $stmt = $conn->prepare("INSERT INTO jobs (client_id, title, description, job_type, payment) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssd", $client_id, $title, $description, $job_type, $payment);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "New job posted successfully";
    } else {
        $response['message'] = "Error posting the job: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    return $response;
}

function searchJobs($searchQuery) {
    $conn = getConnection();

    $query = "SELECT * FROM jobs WHERE title LIKE ? OR description LIKE ?";
    $stmt = $conn->prepare($query);
    $searchParameter = "%$searchQuery%";
    $stmt->bind_param("ss", $searchParameter, $searchParameter);
    $stmt->execute();
    $result = $stmt->get_result();
    $jobs = [];
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }

    return $jobs;
}

function getAllOpenJobs(){
    $conn = getConnection();

    $status = "open";
    $query = "SELECT * FROM jobs WHERE status = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $jobs = [];
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }

    return $jobs;
}

function searchJobsByJobID($jobID) {
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

// function getJobsByClientId($client_id) {
//     $conn = getConnection();

//     $query = "SELECT j.*, 
//                      a.freelancer_id, 
//                      u.username AS freelancer_username,
//                      a.application_text,
//                      a.application_date,
//                      a.status AS application_status,
//                      p.payment_id,
//                      p.amount AS payment_amount,
//                      p.payment_date
//               FROM jobs j
//               LEFT JOIN applications a ON j.job_id = a.job_id
//               LEFT JOIN users u ON a.freelancer_id = u.user_id
//               LEFT JOIN payments p ON j.job_id = p.job_id AND a.freelancer_id = p.freelancer_id
//               WHERE j.client_id = ?";
    
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("i", $client_id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $jobs = [];
//     while ($row = $result->fetch_assoc()) {
//         $jobs[] = $row;
//     }
//     return $jobs;
// }

function getJobsByClientId($client_id) {
    $conn = getConnection();

    $query = "SELECT j.*, 
                     GROUP_CONCAT(DISTINCT u.username ORDER BY u.username ASC SEPARATOR ', ') AS freelancer_usernames,
                     GROUP_CONCAT(DISTINCT a.application_text ORDER BY a.application_date ASC SEPARATOR '; ') AS application_texts,
                     GROUP_CONCAT(DISTINCT a.status ORDER BY a.application_date ASC SEPARATOR ', ') AS application_statuses,
                     GROUP_CONCAT(DISTINCT p.payment_id ORDER BY p.payment_date ASC SEPARATOR ', ') AS payment_ids,
                     SUM(p.amount) AS total_payment_amount
              FROM jobs j
              LEFT JOIN applications a ON j.job_id = a.job_id
              LEFT JOIN users u ON a.freelancer_id = u.user_id
              LEFT JOIN payments p ON j.job_id = p.job_id AND a.freelancer_id = p.freelancer_id
              WHERE j.client_id = ?
              GROUP BY j.job_id";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $jobs = [];
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
    return $jobs;
}


//delete job 
function deleteJob($jobID) {
    try {
        $conn = getConnection();
        $query = "DELETE FROM jobs WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $jobID);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

//update job
function updateJob($jobID, $title, $description, $jobType, $payment) {
    $conn = getConnection();
    $response = ['success' => false, 'message' => ''];
    try {
        $query = "UPDATE jobs SET title = ?, description = ?, job_type = ?, payment = ? WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdsi", $title, $description, $jobType, $payment, $jobID);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Job updated successfully";
        } else {
            $response['message'] = "Error updating the job: " . $stmt->error;
        }
    } catch (Exception $e) {
        $response['message'] = "Exception: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }

    return $response;
}


function updateJobStatus($jobId, $status) {
    try {
        $conn = getConnection();
        $validStatusValues = ["open", "in progress", "completed"]; 
        if (!in_array($status, $validStatusValues)) {
            throw new Exception("Invalid status value.");
        }

        $query = "UPDATE jobs SET status = ? WHERE job_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $jobId);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
}




?>
