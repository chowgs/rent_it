<?php
session_start();
require_once('../config/connect.php'); // Ensure connection is properly included

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $stmt = $conn->prepare("SELECT * FROM account WHERE VerificationToken = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the token is found in the database, proceed to update the account status
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // If token matches, update the account status to 'verified' (1)
        if ($user['Status'] == 0) {
            $stmt_update = $conn->prepare("UPDATE account SET Status = '1' WHERE VerificationToken = ?");
            $stmt_update->bind_param("s", $token);
            if ($stmt_update->execute()) {
                $_SESSION['success_message'] = "Your account has been successfully verified.";
            } else {
                $_SESSION['error_message'] = "Error updating account status.";
            }
        } else {
            $_SESSION['error_message'] = "Your account is already verified.";
        }
    } else {
        $_SESSION['error_message'] = "Invalid or expired verification token.";
    }
} else {
    $_SESSION['error_message'] = "No verification token provided.";
}

// Redirect the user to a page (e.g., login page or home)
header("Location: ../login_page.php");
exit;
?>
