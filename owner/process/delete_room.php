<?php
session_start();
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $roomID = $_POST['id'];

    // Start a transaction
    $conn->begin_transaction();

    // Fetch the PropertyID of the room to be deleted
    $sql = "SELECT PropertyID FROM room WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roomID);
    $stmt->execute();
    $result = $stmt->get_result();
    $propertyID = null;

    if($result->num_rows > 0){
        $room = $result->fetch_assoc();
        $propertyID = $room['PropertyID'];
    } else {
        $_SESSION['error_message'] = "Room not found.";
        echo "error";
        $stmt->close();
        $conn->rollback();
        $conn->close();
        exit;
    }

    // Close the statement for the first query
    $stmt->close();

    // Delete the room
    $sql = "DELETE FROM room WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roomID);

    if(!$stmt->execute()){
        echo "error: Failed to delete room";
        $stmt->close();
        $conn->rollback();
        $conn->close();
        exit;
    }

    // Close the statement for the delete query
    $stmt->close();

    // Update the property table and decrement the total_room column
    $sql = "UPDATE property SET Total_Room = Total_Room - 1 WHERE PropertyID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $propertyID);

    if($stmt->execute()){
        // Commit the transaction
        $conn->commit();
        $_SESSION['success_message'] = "Room deleted successfully.";
        echo "success";
        exit;
    } else {
        echo "error: Failed to update property";
        $conn->rollback();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
