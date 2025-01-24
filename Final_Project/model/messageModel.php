<?php
require_once("db.php");

function sendMessage($senderId, $receiverId, $messageText) {
    $conn = getConnection();

    $query = "INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $senderId, $receiverId, $messageText);
    
    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}

function getMessages($userId) {
    $conn = getConnection();

    $query = "SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ? ORDER BY send_date";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $userId, $userId);
    $stmt->execute();

    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $messages;
}


?>