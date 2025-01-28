<?php
session_start();
require_once("../../config/connect.php");

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["BoarderId"]) && !empty($_POST["BoarderId"])) {
        $boarderID = $_POST["BoarderId"];
        $accountID = $_SESSION["AccountID"];

        // Retrieve the OwnerID based on the AccountID
        $sql = "SELECT OwnerID FROM owner WHERE AccountID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $accountID);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ownerID = $row['OwnerID']; 

            // Retrieve the RoomID based on the OwnerID and BoarderID
            $sqlroom = "SELECT * FROM room WHERE OwnerID = ? AND BoarderID = ?";
            $stmtroom = $conn->prepare($sqlroom);
            $stmtroom->bind_param("ss", $ownerID, $boarderID);
            $stmtroom->execute();
            $resultroom = $stmtroom->get_result();
        
            if ($resultroom->num_rows > 0) {
                $rowroom = $resultroom->fetch_assoc();
                $roomID = $rowroom['RoomID']; 
                $propertyID = $rowroom['PropertyID']; 

                // Update the room status to 'Vacant' and set BoarderID to null
                $update = "UPDATE room SET Status = 'Vacant', BoarderID = null WHERE RoomID = ? AND OwnerID = ?";
                $updatestmt = $conn->prepare($update);
                $updatestmt->bind_param("ss", $roomID, $ownerID);
                
                if ($updatestmt->execute()) {

                    $logID = generateLogID($conn); 
                    $activity = 'Check-out';

                    $logSql = "INSERT INTO book_log (LogID, Activity, LogDate, RoomID, PropertyID, BoarderID, OwnerID) VALUES (?, ?, NOW(), ?, ?, ?, ?)";
                    $logStmt = $conn->prepare($logSql);
                    $logStmt->bind_param("ssssss", $logID, $activity, $roomID, $propertyID, $boarderID, $ownerID);

                    if ($logStmt->execute()) {
                        $_SESSION['success_message'] = "Boarder checkout successful and log updated.";
                    } else {
                        $_SESSION['error_message'] = "Boarder checkout successful but log update failed: " . $conn->error;
                    }

                    $logStmt->close();
                } else {
                    $_SESSION['error_message'] = "Boarder checkout failed.". $conn->error;

                }
                 
                // Close the update statement
                $updatestmt->close();
                
            } else {
                $_SESSION['error_message'] = "No room found for the specified boarder.". $conn->error;

            }

            // Close the room statement
            $stmtroom->close();
        } else {
            $_SESSION['error_message'] = "Owner not found.". $conn->error;

        }

        // Close the owner statement
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Boarder ID is required.". $conn->error;

    }
} else {
    $_SESSION['error_message'] = "Invalid request method.". $conn->error;

}

// Redirect to the tenant page
header("Location: ../tenant.php");
exit;

// Close the database connection
$conn->close();
?>
