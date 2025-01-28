<?php
// Include your database connection file
require_once("../config/connect.php");

$username = $_POST['username'];
$answer = $_POST['answer'];

// Fetch the stored security answer for the given username
$query = $conn->prepare("SELECT Answer FROM account WHERE UName = ?");
$query->bind_param('s', $username);
$query->execute();
$query->bind_result($storedAnswer);
$query->fetch();

if ($storedAnswer) {
    // Verify the provided answer against the stored hashed answer
    if ($answer == $storedAnswer) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Incorrect answer']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username not found']);
}

$query->close();
$conn->close();
?>
