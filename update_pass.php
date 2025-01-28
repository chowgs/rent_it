<?php
require_once("config/connect.php");

// Fetch all users with plaintext passwords
$sql = "SELECT AccountID, PWord FROM account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iterate through each user
    while($row = $result->fetch_assoc()) {
        $userId = $row['AccountID'];
        $plainPassword = $row['PWord'];

        // Hash the password
        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

        // Update the database with the hashed password
        $updateSql = "UPDATE account SET PWord='$hashedPassword' WHERE AccountID='$userId'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Record updated successfully for user ID: $userId\n";
        } else {
            echo "Error updating record: " . $conn->error . "\n";
        }
    }
} else {
    echo "0 results";
}

$conn->close();
?>
