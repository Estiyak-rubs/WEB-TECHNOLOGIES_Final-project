<?php
require_once("../model/userModel.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
    $results = searchFreelancer($searchQuery);
} else {
    header("Location: ../view/clientDashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../asset/css/searchFreelancer.css">
</head>
<body>
    <nav class="navbar">
        <a href="../view/clientDashboard.php">Dashboard</a> |
        <a href="../view/profile.php">Profile</a> |
        <a href="../view/jobpost.php">Job Post</a> |
        <a href="../view/settings.php">Settings</a> |
        <a href="../controller/logoutCheck.php">Logout</a>
    </nav>

    <section class="results-section">
        <h2>Search Results</h2>
        <?php if (empty($results)) : ?>
            <p class="no-results">No freelancers found.</p>
        <?php else : ?>
            <ul class="results-list">
                <?php foreach ($results as $result) : ?>
                    <li class="result-item">
                        <strong>Username:</strong> <?php echo $result['username']; ?><br>
                        <strong>User ID:</strong> <?php echo $result['user_id']; ?><br>
                        <hr>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <a href="../view/clientDashboard.php" class="back-button">Back to Dashboard</a>
    </section>
</body>
</html>
