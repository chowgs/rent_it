<?php
session_start();
require_once("../../config/connect.php");

if (isset($_POST['receiverID'])) {
    $boarderID = $_SESSION['AccountID'];
    $receiverID = $_POST['receiverID'];

    // Update seen status for messages sent by the boarder and not seen by the receiver
    $update_seen_query = "UPDATE messages SET Seen = 1 WHERE ReceiverID = ? AND SenderID = ? AND Seen = 0";
    $stmt_update = $conn->prepare($update_seen_query);
    $stmt_update->bind_param("ss", $boarderID, $receiverID);
    $stmt_update->execute();
    $stmt_update->close();

    // Fetch conversation messages between boarder and selected receiver
    $query = "SELECT * FROM messages 
              WHERE (SenderID = ? AND ReceiverID = ?) OR (SenderID = ? AND ReceiverID = ?)
              ORDER BY Timestamp ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $boarderID, $receiverID, $receiverID, $boarderID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Variable to track current date for grouping messages
    $currentDate = null;

    // Variable to store the last message ID for checking
    $lastMessageID = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $messageText = htmlspecialchars($row['MessageText']);
            $messageTimestamp = strtotime($row['Timestamp']);
            $formattedTimestamp = date("g:i A", $messageTimestamp);
            $messageDate = date("F j, Y", $messageTimestamp);
            $senderID = $row['SenderID'];
            $seen_status = $row['Seen'] ? 'Seen' : 'Unseen';

            // Display date header if it's a new day
            if ($messageDate !== $currentDate) {
                echo '<div class="message-date">' . $messageDate . '</div>';
                $currentDate = $messageDate;
            }

            // Determine if the message was sent by boarder or receiver
            $messageFrom = ($senderID == $boarderID) ? '' : 'Boarder';

            // Style messages based on sender
            $messageClass = ($senderID == $boarderID) ? 'sent' : 'received';

            echo '<div class="message ' . $messageClass . '">';
            echo "<p>$messageText</p>";
            echo "<p class='message-timestamp'>$formattedTimestamp</p>";
            echo '</div>';

            // Store the last message ID
            $lastMessageID = $row['MessageID'];
        }

        // Display "Seen" status after the last message if it's sent by the boarder
        if (!is_null($lastMessageID) && $senderID == $boarderID && $seen_status == 'Seen') {
            echo '<div><span class="seen-status">Seen</span></div>';
        }
    } else {
        echo '<p>No messages found.</p>';
    }

    $stmt->close();
} else {
    echo '<p>Receiver ID not provided.</p>';
}

$conn->close();
?>
