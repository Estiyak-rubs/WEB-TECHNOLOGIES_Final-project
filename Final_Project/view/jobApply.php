<?php
    session_start();
    require_once("../controller/authCheck.php");
    checkLoggedIn();
    checkUserType("freelancer","login.php");
    if (isset($_GET['job_id'])) {
        $jobId = $_GET['job_id'];
        $_SESSION['jobid'] = $jobId;
        $freelancerId = $_SESSION['user_id'];
    }
?>
<html>
<head>
    <title>Freelancer Dashboard</title>
    <link rel="stylesheet" href="../asset/css/index.css">
    <link rel="stylesheet" href="../asset/css/jobView.css">
    <script src="../asset/js/freelancerViewJob.js"></script>
    <script src="../asset/js/freelancerJobStatus.js"></script>
</head>
<body>
<nav align="right">
    <a href="freelancerDashboard.php">Home</a>|
    <a href="profile.php">Profile</a>|
    <a href="settings.php">Settings</a>|
    <a href="../controller/logoutCheck.php">Logout</a>
    <br>
</nav>
<section>
        <fieldset>
            <legend><h2>Job Info</h2></legend>
            <div id="job"></div>
        </fieldset>
        <fieldset>
            <legend><h2>Application Status</h2></legend>
            <div id="jobStatus" align="center">
                <?php
                    require_once("../model/applicationModel.php");
                    $status = fetchStatus($jobId, $freelancerId);
                    echo ucfirst($status);
                    if($status == "accepted"){
                        echo "<br>Project Ongoing";
                    }
                ?>
            </div>
        </fieldset>
        <?php
            require_once("../model/applicationModel.php");
            
            if(!checkReApply($jobId, $freelancerId)){
                echo "<fieldset>
                    <legend><h2>Apply to Job</h2></legend>
                    <form action='../controller/FreelancerJobApply.php' method='post'>
                        
                        <label>Application Text:</label><br>
                        <textarea id='description' name='description' rows='4' cols='50' required></textarea><br><br>
                        <br><br>
                        <input type='submit' value='Apply'>
                    </form>
                </fieldset>";
            }
        ?>
</section>
</body>
</html>