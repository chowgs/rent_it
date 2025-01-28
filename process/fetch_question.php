<?php
// Include your database connection file
require_once("../config/connect.php");

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Ensure the response is JSON

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$username = $_POST['username'];

// Fetch security question
$query = $conn->prepare("SELECT SQuestion FROM account WHERE UName = ?");
if ($query === false) {
    die(json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]));
}
$query->bind_param('s', $username);
$query->execute();
$query->bind_result($question);
$query->fetch();

if ($question) {
    echo json_encode(['success' => true, 'question' => $question]);
} else {
    echo json_encode(['success' => false, 'message' => 'Username not found']);
}

$query->close();
$conn->close();
?>
