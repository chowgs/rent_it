<?php

require_once("../../config/connect.php");

$data = json_decode(file_get_contents('php://input'), true);
$boarderID = $data['boarderID'];

function generateLogID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM book_log WHERE LogID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

function generateNotifID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM notif WHERE NotifID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

// Fetch the boarder's full name
$fetchBoarderNameSql = "SELECT FullName, AccountID FROM boarder WHERE BoarderID = ?";
$stmt = $conn->prepare($fetchBoarderNameSql);
$stmt->bind_param("s", $boarderID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row['FullName'];
    $accountID = $row['AccountID'];

    // Update booking table
    $updateBookingSql = "UPDATE booking SET Status = 'Accepted' WHERE BoarderID = ?";
    $stmt = $conn->prepare($updateBookingSql);
    $stmt->bind_param("s", $boarderID);
    $stmt->execute();

    // Fetch RoomID, PropertyID, and OwnerID from booking table
    $fetchDetailsSql = "SELECT RoomID, PropertyID, OwnerID FROM booking WHERE BoarderID = ?";
    $stmt = $conn->prepare($fetchDetailsSql);
    $stmt->bind_param("s", $boarderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $roomID = $row['RoomID'];
        $propertyID = $row['PropertyID'];
        $ownerID = $row['OwnerID'];

        // Update room table
        $updateRoomSql = "UPDATE room SET Status = 'Booked', BoarderID = ? WHERE RoomID = ?";
        $stmt = $conn->prepare($updateRoomSql);
        $stmt->bind_param("ss", $boarderID, $roomID);
        $stmt->execute();

        // Insert log entry
        $logID = generateLogID($conn); // Generate a unique ID for the log entry
        $activity = 'Check-in';
        
        $insertLogSql = "INSERT INTO book_log (LogID, Activity, LogDate, RoomID, PropertyID, BoarderID, OwnerID) VALUES (?, ?, NOW(), ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertLogSql);
        $stmt->bind_param("ssssss", $logID, $activity, $roomID, $propertyID, $boarderID, $ownerID);
        $stmt->execute();

        // Create and insert notification message
        $notifID = generateNotifID($conn); // Generate a unique ID for the notification
        $notificationMessage = "Dear $fullName,

        We are pleased to inform you that your booking has been accepted! Your room is now ready for check-in. Please proceed to the property at your earliest convenience.
        
        Thank you for choosing our services. We look forward to welcoming you.";
        $insertNotificationQuery = "INSERT INTO notif (NotifID, Message, Time_stamp, AccountID)
                                    VALUES (?, ?, NOW(), ?)";
        $stmtInsertNotification = $conn->prepare($insertNotificationQuery);
        $stmtInsertNotification->bind_param('sss', $notifID, $notificationMessage, $accountID);
        $stmtInsertNotification->execute();
    }
}

$stmt->close();
$conn->close();

// Return response
echo json_encode(['message' => 'Booking accepted']);
?>
