<?php
session_start();
require_once("../../config/connect.php");

function accountID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM account WHERE AccountID = '$scrambledId'";
        $checkResult = $conn->query($checkQuery);
        $count = $checkResult->fetch_assoc()['count'];
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

function adminID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM admin WHERE AdminID = '$scrambledId'";
        $checkResult = $conn->query($checkQuery);
        $count = $checkResult->fetch_assoc()['count'];
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize user input
    $username = $_POST['uname'];
    $password = $_POST['pword'];
    $accountID = accountID($conn);
    $adminID = adminID($conn);
    $acctype = "Admin";
    $status = "1";

        // Check if username is already taken
        $stmt = $conn->prepare("SELECT AccountID FROM account WHERE UName = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) { 
            // Username already exists
            $_SESSION['error_message'] = "Username already exists.";
        } else {
            // Username is available, insert new record
            $stmt->close();
    
            // Insert the new account into the database
            $stmt = $conn->prepare("INSERT INTO account (AccountID, UName, PWord, AccType, Status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $accountID, $username, $password, $acctype, $status);
    
            if ($stmt->execute()) {

                $adminstmt = $conn->prepare("INSERT INTO admin (AdminID, AccountID) VALUES (?, ?)");
                $adminstmt->bind_param("ss", $adminID, $accountID);
                if ($adminstmt->execute()) {
                    $_SESSION['success_message'] = "Admin acount added successfully.";
                }else {
                    $_SESSION['error_message'] = "Adding admin account failed.";
                }
                
            }else {
                $_SESSION['error_message'] = "Adding admin account failed.";
            }
        }
}

header("Location: ../all_users/admin.php");
exit;
$stmt->close();
$conn->close();

?>
