<?php
    session_start();
    require_once("../controller/authCheck.php");
    checkLoggedIn();
    checkUserType("client", "login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Form</title>
    <link rel="stylesheet" href="../asset/css/jobpost.css">
    <script src="../asset/js/jobPostValidation.js"></script>
</head>
<body>
    <nav class="navbar">
        <a href="clientDashboard.php">Home</a> |
        <a href="project.php">Projects</a> |
        <a href="profile.php">Profile</a> |
        <a href="jobpost.php">JobPost</a> |
        <a href="settings.php">Settings</a> |
        <a href="../controller/logoutCheck.php">Logout</a>
    </nav>
    
    <section class="form-container">
        <fieldset>
            <legend><h2>Post a Job</h2></legend>
            <form action="../controller/clientJobsPost.php" method="post" onsubmit="return jobPostValidition();">
                <label for="title">Job Title:</label><br>
                <input type="text" id="title" name="title"><br><br>
                
                <label for="description">Job Description:</label><br>
                <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
                
                <label>Job Type:</label><br>
                <input type="radio" id="hourly" name="job_type" value="hourly" checked>
                <label for="hourly">Hourly</label><br>
                <input type="radio" id="fixed" name="job_type" value="fixed">
                <label for="fixed">Fixed</label><br><br>
                
                <label for="payment">Payment Amount:</label><br>
                <input type="number" id="payment" name="payment" step="0.01"><br><br>
                
                <input type="submit" value="Submit">
            </form>
            <?php require("../controller/errorShowing.php"); ?>
        </fieldset>
    </section>
</body>
</html>
