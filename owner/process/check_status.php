<?php
session_start();
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $roomID = $_POST['id'];

    $sql = "SELECT Status FROM room WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['status' => '', 'error' => 'Prepare statement failed']);
        exit;
    }
    
    $stmt->bind_param("s", $roomID);
    if (!$stmt->execute()) {
        echo json_encode(['status' => '', 'error' => 'Execute statement failed']);
        exit;
    }
    
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $room = $result->fetch_assoc();
        echo json_encode(['status' => $room['Status'], 'error' => '']);
    } else {
        echo json_encode(['status' => '', 'error' => 'No rows found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => '', 'error' => 'ID not set']);
}
?>
