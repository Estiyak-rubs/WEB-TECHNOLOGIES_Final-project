<?php
session_start();
require_once('../model/jobModel.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $job_type = $_POST['job_type'];
    $payment = $_POST['payment'];
    $client_id = $_SESSION["user_id"];

    $result = postJob($client_id, $title, $description, $job_type, $payment);

    if ($result['success']) {
        header("Location: ../view/jobpost.php?success=" . urlencode($result['message']));
        exit();
    } else {
        header("Location: ../view/jobpost.php?error=" . urlencode($result['message']));
        exit();
    }
}

header("Location: ../view/jobpost.php");
exit();
?>
