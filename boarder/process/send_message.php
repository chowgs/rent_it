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

if (isset($_POST['message']) && isset($_POST['ownerID']) && isset($_POST['boarderID'])) {
    $message = $_POST['message'];
    $ownerID = $_POST['ownerID'];
    $boarderID = $_POST['boarderID'];
    $messageID = generateMessageID($conn);

    $ownerAccountQuery = "SELECT AccountID FROM owner WHERE OwnerID = ?";
    $ownerAccountStmt = $conn->prepare($ownerAccountQuery);
    $ownerAccountStmt->bind_param("s", $ownerID);
    $ownerAccountStmt->execute();
    $ownerAccountResult = $ownerAccountStmt->get_result();
    $ownerAccount = $ownerAccountResult->fetch_assoc();
    $receiverID = $ownerAccount['AccountID'];

    // Insert the message into the database
    $sql = "INSERT INTO messages (MessageID, SenderID, ReceiverID, MessageText) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $messageID, $boarderID, $receiverID, $message);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error'.$stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error'.$stmt->error;
}
?>
