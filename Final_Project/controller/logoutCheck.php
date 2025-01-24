<?php
session_start();
$_SESSION = array();
session_destroy();
if (isset($_COOKIE['login_expiration'])){
    setcookie('login_expiration', '', time() - 3600, "/");
}

if (isset($_GET['message']) && $_GET['message'] === 'session_expired') {
    echo "<script>
        alert('Your session has expired. Please log in again.');
        window.location.href = '../view/login.php';
    </script>";
    exit();
}

header("location: ../view/login.php");
exit();
?>
