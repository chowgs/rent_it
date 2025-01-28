<?php
session_start();
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $roomID = $_POST['id'];

    $sql = "SELECT * FROM room WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roomID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $room = $result->fetch_assoc();
        echo json_encode($room);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $conn->close();
}
?>
