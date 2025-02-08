<?php
session_start();
require_once("../../config/connect.php");

function generateUniqueID($conn, $table, $column, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $max_attempts = 10;
    $attempts = 0;

    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM $table WHERE $column = ?");
        $stmt->bind_param("s", $scrambledId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        $attempts++;
        if ($attempts >= $max_attempts) {
            die("Error: Could not generate unique ID.");
        }
    } while ($count > 0);

    return $scrambledId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = trim($_POST['uname']);
    $password = password_hash($_POST['pword'], PASSWORD_BCRYPT);
    $accountID = generateUniqueID($conn, "account", "AccountID");
    $adminID = generateUniqueID($conn, "admin", "AdminID");
    $acctype = "Admin";
    $status = "1";
    $Approval = "Approved";
    $secret = "admin";

    // Check if username is taken
    $stmt = $conn->prepare("SELECT AccountID FROM account WHERE UName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) { 
        $_SESSION['error_message'] = "Username already exists.";
        $stmt->close();
        header("Location: ../all_users/admin.php");
        exit;
    }
    $stmt->close();

    // Insert account
    $stmt = $conn->prepare("INSERT INTO account (AccountID, UName, PWord, AccType, Status, Approval, Answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $accountID, $username, $password, $acctype, $status, $Approval, $secret);

    if ($stmt->execute()) {
        // Insert admin
        $adminstmt = $conn->prepare("INSERT INTO admin (AdminID, FullName, Department, AccountID, Email, ContNum) VALUES (?, ?, ?, ?, ?, ?)");
$adminstmt->bind_param("ssssss", $adminID, $username, $department, $accountID, $email, $contNum);

$department = "Administration";
$email = "admin@admin";
$contNum = "09123456";
        if ($adminstmt->execute()) {
            $_SESSION['success_message'] = "Admin account added successfully.";
        } else {
            $_SESSION['error_message'] = "Adding admin account failed. Error: " . $adminstmt->error;
        }
        $adminstmt->close();
    } else {
        $_SESSION['error_message'] = "Adding account failed. Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
header("Location: ../all_users/admin.php");
exit;
?>
