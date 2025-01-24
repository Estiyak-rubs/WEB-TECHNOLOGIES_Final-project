<?php
session_start();

require_once("../model/userModel.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = getUserByUsername($username);

    if ($user) {
        if ($password == $user['PASSWORD']) {
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_id'] = $user['user_id'];

            $timeout_duration = 120;
            setcookie('login_expiration', time() + $timeout_duration, time() + $timeout_duration, "/");


            if ($user['user_type'] == 'client') {
                header("location: ../view/clientDashboard.php");
            } elseif ($user['user_type'] == 'freelancer') {
                header("location: ../view/freelancerDashboard.php");
            } elseif ($user['user_type'] == 'admin') {
                header("location: ../view/adminDashboard.php");
            }else{}
            
            exit();
        } else {
            $errorMessage = "Invalid password";
        }
    } else {
        $errorMessage = "Invalid username";
    }

    header("location: ../view/login.php?error=" . urlencode($errorMessage));
    exit();
} else {
    header("location: ../view/login.php");
    exit();
}
?>
