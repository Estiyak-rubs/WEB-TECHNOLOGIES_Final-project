<?php
    if (isset($_GET['error'])) {
        $errorMessages = urldecode($_GET['error']);
        echo '<p style="color: red;">' . $errorMessages . '</p>';
    }
    if (isset($_GET['success'])) {
        $successMessage = $_GET['success'];
        echo '<p style="color: green;">' . htmlspecialchars($successMessage) . '</p>';
    }
?>   