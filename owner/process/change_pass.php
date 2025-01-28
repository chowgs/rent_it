<?php
session_start();
require_once("../../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_SESSION["AccountID"];
    $old_pass = $_POST["old_pass"];
    $new_pass = $_POST["new_pass"];

    // Fetch the current password from the database
    $sql = "SELECT PWord FROM account WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['error_message'] = "Error preparing the statement.";
        header("Location: ../profile.php");
        exit;
    }

    $stmt->bind_param("s", $accountID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($current_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Verify the old password
        if (password_verify($old_pass, $current_password)) {
            // Hash the new password
            $hashed_new_pass = password_hash($new_pass, PASSWORD_BCRYPT);

            // Update the password in the database
            $update_sql = "UPDATE account SET PWord = ? WHERE AccountID = ?";
            $update_stmt = $conn->prepare($update_sql);

            if ($update_stmt === false) {
                $_SESSION['error_message'] = "Error preparing the update statement.";
                header("Location: ../profile.php");
                exit;
            }

            $update_stmt->bind_param("ss", $hashed_new_pass, $accountID);

            if ($update_stmt->execute()) {
                $_SESSION['success_message'] = "Password changed successfully.";
            } else {
                $_SESSION['error_message'] = "Error updating password: " . $conn->error;
            }

            $update_stmt->close();
        } else {
            $_SESSION['error_message'] = "Old password is incorrect.";
        }
    } else {
        $_SESSION['error_message'] = "User not found.";
    }

    $stmt->close();
}

$conn->close();
header("Location: ../profile.php");
exit;
?>
