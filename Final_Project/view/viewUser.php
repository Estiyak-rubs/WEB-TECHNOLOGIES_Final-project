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
    <title>View User</title>
    <script src="../asset/js/ajaxForViewUser.js"></script>
    <link rel="stylesheet" href="../asset/css/adminviewUser.css">
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

        <div class="user-selection">
            <label for="user_type">Select User-Type:</label>
            <select id="user_type" name="user_type">
                <option value="client">Client</option>
                <option value="freelancer">Freelancer</option>
                <option value="admin">Admin</option>
            </select>
            <button id="viewUserBtn" class="btn">View</button>
        </div>

        <div id="showUserlist" class="user-list"></div>
        <div id="deltemsg" class="message"></div>

        <hr>

        <div id="editPannel" class="edit-panel">
            <h3>Edit Panel</h3>
            <form action="editForm" method="POST">
                <input type="text" id="editFormID" style="display: none;">
                <input type="text" id="editFormName" placeholder="Enter Name" class="input-field">
                <input type="text" id="editFormEmail" placeholder="Enter Email" class="input-field">
                <input type="text" id="editFormPassWord" placeholder="Enter Password" class="input-field">
                <button id="EditSave" class="btn">Save</button>
            </form>
            <div id="showEditMsg" class="message"></div>
        </div>
    </div>
</body>
</html>
