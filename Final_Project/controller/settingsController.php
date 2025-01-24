<?php
session_start();
require_once("../controller/authCheck.php");
require_once("../model/userModel.php");
require_once("../model/userModel.php");

checkLoggedIn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];

    if (isset($_POST['changePassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];

        $user = getUserByUsername($username);

        if ($user && $currentPassword == $user['PASSWORD']) {
            updateUserPassword($username, $newPassword);
            $successMessage = "Password updated successfully!";
        } else {
            $errorMessage = "Current password is incorrect.";
        }        
    } elseif (isset($_POST['changeEmail'])) {
        $newEmail = $_POST['newEmail'];
        updateUserEmail($username, $newEmail);
        $successMessage = "Email updated successfully!";
    }
}

if (isset($errorMessage)) {
    header("Location: ../view/settings.php?error=" . urlencode($errorMessage));
    exit();
} elseif (isset($successMessage)) {
    header("Location: ../view/settings.php?success=" . urlencode($successMessage));
    exit();
}
?>
