<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

function generateBookID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM booking WHERE BookID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

if (isset($_POST['RoomID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $ownerID = $_POST['OwnerID'];
    $accountID = $_SESSION['AccountID'];
    $bookID = generateBookID($conn);
    $status = 'Pending';

    // Get the BoarderID using the AccountID from the boarder table
    $sql = "SELECT BoarderID FROM boarder WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $accountID);
    $stmt->execute();
    $stmt->bind_result($boarderID);
    $stmt->fetch(); 
    $stmt->close();

    if ($boarderID) {
        // Check if the boarder already has a pending booking
        $checkBookingQuery = "SELECT COUNT(*) AS count FROM booking WHERE BoarderID = ? AND Status = 'Pending'";
        $checkBookingStmt = $conn->prepare($checkBookingQuery);
        $checkBookingStmt->bind_param("s", $boarderID);
        $checkBookingStmt->execute();
        $checkBookingResult = $checkBookingStmt->get_result();
        $bookingCount = $checkBookingResult->fetch_assoc()['count'];
        $checkBookingStmt->close();
        
        if ($bookingCount > 0) {
            echo 'error'; // Boarder already has a pending booking
        } else {
            // Check if the room already has a boarder assigned
            $checkRoomQuery = "SELECT BoarderID FROM room WHERE PropertyID = ? AND BoarderID = ?";
            $checkRoomStmt = $conn->prepare($checkRoomQuery);
            $checkRoomStmt->bind_param("ss", $propID, $boarderID);
            $checkRoomStmt->execute();
            $checkRoomStmt->bind_result($existingBoarderID);
            $checkRoomStmt->fetch();
            $checkRoomStmt->close();

            if ($existingBoarderID) {
                echo 'room_error'; // Room already has a boarder assigned
            } else {
                // Insert the booking record into the booking table
                $sql = "INSERT INTO booking (BookID, BookDate, Status, RoomID, PropertyID, BoarderID, OwnerID) VALUES (?, NOW(), ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $bookID, $status, $roomID, $propID, $boarderID, $ownerID);
                
                if ($stmt->execute()) {
                    // Update the room with the boarder's ID
                    $update = "UPDATE room SET BoarderID = ? WHERE RoomID = ?";
                    $updatestmt = $conn->prepare($update);
                    $updatestmt->bind_param("ss", $boarderID, $roomID);
                    
                    if ($updatestmt->execute()) {
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                } else {
                    echo 'error';
                }

                $stmt->close();
            }
        }
    } else {
        echo 'error';
    }

    $conn->close();
} else {
    echo 'error';
}
?>
