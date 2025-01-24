<?php
session_start();
require_once("../controller/authCheck.php");
require_once("../model/jobModel.php");
checkLoggedIn();
checkUserType("freelancer", "login.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $jobs = searchJobs($searchQuery);
    include("../view/freelancerDashboard.php");
} else {
    header("Location: freelancerDashboard.php");
    exit();
}
?>
