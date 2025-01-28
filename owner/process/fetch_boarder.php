<?php
// fetch_boarder_details.php - Sample PHP script to fetch boarder details based on ID
require_once("../../config/connect.php");

// Parse incoming JSON request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $boarderID = $data['id'];

    $sql = "SELECT * FROM boarder WHERE BoarderID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $boarderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No details found']);
    }

    $stmt->close();
    $conn->close();
}
?>
