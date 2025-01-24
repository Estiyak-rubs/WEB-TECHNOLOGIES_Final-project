<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $userId = $_SESSION['user_id'];
        $uploadDir = '../asset/images/';
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $userId . '.png'; // Save as <user_id>.png for easy lookup
        $destPath = $uploadDir . $fileName;

        // Validate file type
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileMimeType = mime_content_type($fileTmpPath);

        if (in_array($fileMimeType, $allowedMimeTypes)) {
            // Move the file to the destination directory
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $_SESSION['success_message'] = 'Profile picture updated successfully!';
            } else {
                $_SESSION['error_message'] = 'Error moving the uploaded file.';
            }
        } else {
            $_SESSION['error_message'] = 'Invalid file type. Please upload a valid image.';
        }
    } else {
        $_SESSION['error_message'] = 'Error uploading file. Please try again.';
    }

    // Redirect back to the profile page
    header('Location: ../view/profile.php');
    exit();
} else {
    // Redirect back if not a POST request
    $_SESSION['error_message'] = 'Invalid request.';
    header('Location: ../view/profile.php');
    exit();
}
?>
