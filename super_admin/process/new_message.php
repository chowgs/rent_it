<?php
session_start();
require_once("../../config/connect.php");

function generateMessageID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM messages WHERE MessageID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

if (isset($_POST['message']) && isset($_POST['receiverID'])) {
    $message = trim($_POST['message']);
    $receiverID = $_POST['receiverID'];
    $boarderID = $_SESSION['AccountID'];
    // Message length limit
    $maxLength = 100;

    if (strlen($message) > $maxLength) {
        echo 'Message exceeds character limit of ' . $maxLength;
        exit;
    }
    
    $messageID = generateMessageID($conn);

    // Insert the message into the database
    $sql = "INSERT INTO messages (MessageID, SenderID, ReceiverID, MessageText) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $messageID, $boarderID, $receiverID, $message);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error: Required parameters not provided';
}
?>
