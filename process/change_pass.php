<?php
require_once("../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $newPassword = $_POST["newPassword"];

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update the password in the database
    $update_sql = "UPDATE account SET PWord = ? WHERE UName = ?";
    $update_stmt = $conn->prepare($update_sql);

    if ($update_stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Error in preparing the statement.']);
        exit;
    }

    $update_stmt->bind_param("ss", $hashedPassword, $username);

    if ($update_stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update password']);
    }

    $update_stmt->close();
}

$conn->close();
?>
