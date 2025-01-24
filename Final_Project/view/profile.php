<?php
    session_start();
    require_once("../controller/authCheck.php");
    checkLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../asset/css/profile.css">
</head>
<body>

    <nav class="navbar">
        <a href="<?php
            if ($_SESSION['user_type'] === 'client') {
                echo 'clientDashboard.php';
            } elseif ($_SESSION['user_type'] === 'freelancer') {
                echo 'freelancerDashboard.php';
            } elseif ($_SESSION['user_type'] === 'admin') {
                echo 'adminDashboard.php';
            }
        ?>">Home</a> |
        <a href="profile.php">Profile</a> |
        <a href="settings.php">Settings</a> |
        <a href="../controller/logoutCheck.php">Logout</a>
    </nav>

    <section class="profile-header">
        <h2>User Profile</h2>
    </section>

    <div class="profile-container">
        <div class="profile-info">
            <?php
                require_once("../model/userModel.php");
                $username = $_SESSION['username'];
                $user = getUserByUsername($username);
                if ($user) {
                    echo "<p><strong>Username:</strong> " . $user['username'] . "</p>";
                    echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
                    echo "<p><strong>User Type:</strong> " . $user['user_type'] . "</p>";
                } else {
                    echo "<p>Error: User not found.</p>";
                }
            ?>
        </div>
        <div class="profile-picture">
            <?php
            $userId = $_SESSION['user_id'];
            $profileImage = "../asset/images/$userId.png";

            // Check if the image exists, otherwise show a default image
            if (!file_exists($profileImage)) {
                $profileImage = "../asset/images/default-profile.png";
            }

            echo "<img src='$profileImage' alt='User Profile Picture'>";
            ?>

            <!-- Upload Form -->
            <form action="../controller/uploadProfileImage.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_image" accept="image/*" required>
                <button type="submit">Upload Image</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Client Dashboard. All Rights Reserved.</p>
    </footer>

</body>
</html>
