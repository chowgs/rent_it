<?php
require_once("../../config/connect.php");

// Check if the form data is submitted via POST and if owner_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['owner_id'])) {
    $ownerID = $_POST['owner_id'];

    // Fetch AccountID based on OwnerID
    $query = "SELECT AccountID FROM owner WHERE OwnerID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ownerID);
    $stmt->execute();
    $stmt->store_result();

    // Check if record exists
    if ($stmt->num_rows > 0) { 
        $stmt->bind_result($accountID);
        $stmt->fetch();

        // Update Approval status
        $updateQuery = "UPDATE account SET Approval = 'Approved' WHERE AccountID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("s", $accountID);

        if ($updateStmt->execute()) {
            $_SESSION['success_message'] = "Owner account approved successfully.";
        } else {
            $_SESSION['error_message'] = "Failed to approve the account";
        }

        $updateStmt->close();
    } else {
        $_SESSION['error_message'] = "Account not found";
    }

    $stmt->close();
} else {
    $_SESSION['error_message'] = "Invalid request";
}
header("Location: ../all_users/pending.php");
exit;
$conn->close();
?>
