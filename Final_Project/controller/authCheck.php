<?php
function checkLoggedIn() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    if (!isset($_SESSION['username'])) {
        header("location: ../view/login.php");
        exit();
    }

    $timeout_duration = 120;

    if (isset($_COOKIE['login_expiration'])) {
        if ($_COOKIE['login_expiration'] < time()) {
            sleep(1);
            header("location: ../controller/logoutCheck.php?message=session_expired");
            exit();
        } else {
            setcookie('login_expiration', time() + $timeout_duration, time() + $timeout_duration, "/");
        }
    } else {
        sleep(1);
        header("location: ../controller/logoutCheck.php?message=session_expired");
        exit();
    }
}

function checkUserType($allowedUserType, $redirectPage) {
    if ($_SESSION['user_type'] !== $allowedUserType) {
        header("location: ../view/$redirectPage");
        exit();
    }
}

function getUserType(){
    $userType = $_SESSION['user_type'];
    return $userType;
}

?>
