<?php
    session_start();
    require_once("../controller/AuthCheck.php");
    checkLoggedIn();
    checkUserType("admin", "Login.php");
?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="../asset/js/ajaxForViewUser.js"></script>
    <link rel="stylesheet" href="../asset/css/admin.css">
    <!-- Add Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <h1>Admin Dashboard</h1>
                </div>
                <ul class="nav-links">
                    <li><a href="AdminDashboard.php">Home</a></li>
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
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        </section>

        <section class="admin-actions">
            <div class="action-button">
                <a href="viewUser.php" class="btn-primary">View and Edit Users</a>
            </div>
            <div class="action-button">
                <a href="insertUser.php" class="btn-primary">Insert User</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Admin Dashboard. All Rights Reserved.</p>
    </footer>

</body>
</html>
