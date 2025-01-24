<?php
    session_start();
    require_once("../controller/AuthCheck.php");
    checkLoggedIn();
    checkUserType("admin", "Login.php");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User</title>
    <script src="../asset/js/ajaxForViewUser.js"></script>
    <link rel="stylesheet" href="../asset/css/admininsertUser.css">
</head>
<body>
    <nav class="navbar">
        <a href="AdminDashboard.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="Settings.php">Settings</a>
        <a href="../controller/logoutCheck.php">Logout</a>
    </nav>

    <div class="container">
        <h3>Welcome, <?php echo $_SESSION['username']; ?></h3>

        <form id="adminInsertForm" action="" method="POST" class="form-container">
            <input type="text" id="uname" class="input-field" placeholder="Enter name" required> <br>
            <input type="email" id="uemail" class="input-field" placeholder="Enter email" required> <br>
            <input type="password" id="upassword" class="input-field" placeholder="Enter password" required> <br>

            <label for="uutype">Select Type:</label>
            <select id="uutype" name="user_type" class="dropdown">
                <option value="client">Client</option>
                <option value="freelancer">Freelancer</option>
                <option value="admin">Admin</option>
            </select> <br>

            <button id="SubmitBtn" class="btn">Submit</button>
        </form>
        <div id="showInsertMsg" class="message"></div>
    </div>
</body>
</html>
