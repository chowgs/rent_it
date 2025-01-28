<?php

require_once("../../config/connect.php");

// Assuming you receive boarderID through POST request
$data = json_decode(file_get_contents('php://input'), true);
$boarderID = $data['boarderID'];

// Update booking table
$updateBookingSql = "UPDATE booking SET Status = 'Declined' WHERE BoarderID = ?";
$stmt = $conn->prepare($updateBookingSql);
$stmt->bind_param("s", $boarderID);
$stmt->execute();

// Optionally update room table or perform other actions if needed

$stmt->close();
$conn->close();

// Return response
echo json_encode(['message' => 'Booking declined']);
?>
