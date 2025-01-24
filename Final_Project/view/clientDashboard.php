<?php
    session_start();
    require_once("../controller/authCheck.php");
    checkLoggedIn();
    checkUserType("client","login.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="../asset/css/client.css">
    <!-- Add Google Fonts for better typography -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> -->
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <h1>JobJunction, Client Dashboard</h1>
                </div>
                <ul class="nav-links">
                    <li><a href="clientDashboard.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <!-- <li><a href="inbox.php">Messages</a></li> -->
                    <li><a href="settings.php">Settings</a></li>
                    <li><a href="../controller/logoutCheck.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="welcome">
            <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
            <button class="btn-primary" onclick="redirectToJobPost()">Post a Job</button>
            <script>function redirectToJobPost() {window.location.href = 'jobpost.php';}</script>
        </section>

        <section class="search">
            <form action="../controller/searchFreelancer.php" method="GET" class="search-form">
                <label for="search"><strong>Search Freelancers:</strong></label>
                <input type="text" id="search" name="search" placeholder="Enter username or user ID" class="search-input">
                <input type="submit" value="Search" class="btn-secondary">
            </form>
        </section>

        <section class="jobs">
            <fieldset>
                <legend><h2>Posted Jobs</h2></legend>
                <div id="jobList"></div>
            </fieldset>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Client Dashboard. All Rights Reserved.</p>
    </footer>

    <script src="../asset/js/clientPostedJob.js"></script>
</body>
</html>
