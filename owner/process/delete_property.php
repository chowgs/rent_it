<?php
session_start();
require_once("../../config/connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["PropertyID"]) && !empty($_POST["PropertyID"])) {
        $propertyID = $_POST["PropertyID"];
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

            // Retrieve the image URLs
            $sqlImg = "SELECT ImgURL FROM property WHERE PropertyID = ?";
            $stmtImg = $conn->prepare($sqlImg);
            $stmtImg->bind_param("s", $propertyID);
            $stmtImg->execute();
            $resultImg = $stmtImg->get_result();
            
            if ($resultImg->num_rows > 0) {
                $rowImg = $resultImg->fetch_assoc();
                $imgURLs = $rowImg['ImgURL'];

                // Split the image URLs into an array
                $imgArray = explode(',', $imgURLs);

                // Delete each image from the server
                foreach ($imgArray as $img) {
                    $imgPath = trim("../".$img);
                    if (file_exists($imgPath)) {
                        unlink($imgPath);
                    }
                }
            }

            // Retrieve the RoomID based on the OwnerID and PropertyID
            $sqlroom = "SELECT RoomID FROM room WHERE PropertyID = ? AND OwnerID = ?";
            $stmtroom = $conn->prepare($sqlroom);
            $stmtroom->bind_param("ss", $propertyID, $ownerID);
            $stmtroom->execute();
            $resultroom = $stmtroom->get_result();
        
            $conn->begin_transaction();
            while ($rowroom = $resultroom->fetch_assoc()) {
                $roomID = $rowroom['RoomID'];

                // Delete the room based on the RoomID
                $deleteSQL = "DELETE FROM room WHERE RoomID = ?";
                $deleteStmt = $conn->prepare($deleteSQL);
                $deleteStmt->bind_param("s", $roomID);
                
                if (!$deleteStmt->execute()) {
                    $conn->rollback();
                    $_SESSION['error_message'] = "Room deletion failed. Please check your Pending Reservations and remove all requests in this room if you want to delete this property or wait until all rooms are vacant.";
                    header("Location: ../property.php");
                    exit;
                }
                $deleteStmt->close();
            }
            $deletePropertySQL = "DELETE FROM property WHERE PropertyID = ?";
            $deletePropertyStmt = $conn->prepare($deletePropertySQL);
            $deletePropertyStmt->bind_param("s", $propertyID);

            if ($deletePropertyStmt->execute()) {
                $conn->commit();
                $_SESSION['success_message'] = "Property deleted successfully.";
            } else {
                $conn->rollback();
                $_SESSION['error_message'] = "Property deletion failed.";
            }

            $deletePropertyStmt->close();

        } else {
            $_SESSION['error_message'] = "Error fetching OwnerID.";
        }
        $stmtImg->close();
    } else {
        $_SESSION['error_message'] = "PropertyID is empty.";
    }
} else {
    $_SESSION['error_message'] = "PropertyID is not set.";
}

// Redirect to the tenant page
header("Location: ../property.php");
exit;

// Close the database connection
$conn->close();
?>
