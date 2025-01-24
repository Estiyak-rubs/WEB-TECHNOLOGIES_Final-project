<?php
require_once('../model/db.php'); 
$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<button onclick=\"applyForJob(" . $row['job_id'] . ")\">Apply</button>";
        echo "</div>";
    }
} else {
    echo "No jobs found.";
}
$conn->close();
?>
