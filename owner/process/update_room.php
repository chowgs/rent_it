<?php
session_start();
require_once("../../config/connect.php");

if(isset($_POST['roomID'])){
    $roomID = $_POST['roomID'];
    $roomNo = $_POST['roomNo'];
    $roomFloor = $_POST['roomFloor'];
    $bed = $_POST['bed'];
    $restroom = $_POST['restRoom'];
    $kitchen = $_POST['kitchen'];
    $livingRoom = $_POST['livingRoom'];

    $sql = "UPDATE room SET Room_No = ?, Room_Flr = ?, Bed = ?, Rest_Room = ?, Kitchen = ?, Liv_Room = ? WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $roomNo, $roomFloor, $bed, $restroom, $kitchen, $livingRoom, $roomID);

    if($stmt->execute()){
        $_SESSION['success_message'] = "Room updated successfully.";
        echo "success";
        exit;
    } else {
        $_SESSION['error_message'] = "Updating room failed.";
        echo "error";
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
