<?php
    session_start();
    require_once("../controller/authCheck.php");
    checkLoggedIn();
?>
<html>
<head>
    <title>Inbox</title>
    <link rel="stylesheet" href="../asset/css/index.css">
</head>
<body>
    <nav align="right">
        <a href="<?php
        if ($_SESSION['user_type'] === 'client') {
            echo 'clientDashboard.php';
        } elseif ($_SESSION['user_type'] === 'freelancer') {
            echo 'freelancerDashboard.php';
        } elseif ($_SESSION['user_type'] === 'admin') {
            echo 'adminDashboard.php';
        } else {
        }
        ?>">Home</a>|
            <a href="profile.php">Profile</a>|
            <a href="settings.php">Settings</a>|
            <a href="../controller/logoutCheck.php">Logout</a>
    </nav>
    <section>

    </section>
</body>
</html>