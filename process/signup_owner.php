<?php
session_start();
require_once("../config/connect.php");

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

function ownerID($conn) {
    // Define the prefix part of the ID
    $prefix = '25R-';

    // Get the last number used in the ID from the database
    $checkQuery = "SELECT OwnerID FROM owner WHERE OwnerID LIKE '25R-%' ORDER BY OwnerID DESC LIMIT 1";
    $checkResult = $conn->query($checkQuery);

    // If no result, start from 0001
    if ($checkResult->num_rows === 0) {
        $newId = $prefix . '0001';
    } else {
        // Fetch the last OwnerID and extract the number part
        $lastOwnerId = $checkResult->fetch_assoc()['OwnerID'];
        $lastNumber = (int)substr($lastOwnerId, 4); // Get number after '25R-'

        // Increment the number and pad it to 4 digits
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $newId = $prefix . $newNumber;
    }

    return $newId;
}


function fileID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM permit WHERE FileID = '$scrambledId'";
        $checkResult = $conn->query($checkQuery);
        $count = $checkResult->fetch_assoc()['count'];
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name_owner = $_POST['name_owner'];
    $user_owner = $_POST['user_owner'];
    $Lastn_owner = $_POST['Lastn_owner'];
    $pass_owner = $_POST['pass_owner'];
    $cont_owner = $_POST['cont_owner'];
    $add_owner = $_POST['add_owner'];
    $email_owner = $_POST['email_owner'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $fblink = $_POST['fblink'];
    $name_land = isset($_POST['name_land']) ? $_POST['name_land'] : null;
    $email_land = isset($_POST['email_land']) ? $_POST['email_land'] : null;
    $cont_land = isset($_POST['cont_land']) ? $_POST['cont_land'] : null;

    // Check if the username already exists
    $check_username_query = "SELECT COUNT(*) AS count FROM account WHERE UName = ?";
    $stmt_check_username = $conn->prepare($check_username_query);
    $stmt_check_username->bind_param("s", $user_owner);
    $stmt_check_username->execute();
    $result_check_username = $stmt_check_username->get_result();
    $username_count = $result_check_username->fetch_assoc()['count'];

    if ($username_count > 0) {
        $_SESSION['error_message'] = "Username already exists. Please choose a different username.";
        header("Location: ../signup_owner.php");
        exit;
    }

    $stmt_check_username->close();

    $accountID = accountID($conn);
    $ownerID = ownerID($conn);

    $accType = "Owner";
    $status = "1";
    $approval = "Pending";
    $hashed_password = password_hash($pass_owner, PASSWORD_BCRYPT);
    // Insert into accounts table
    $stmt_account = $conn->prepare("INSERT INTO account (AccountID, UName, PWord, AccType, Status, Approval, SQuestion, Answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_account->bind_param("ssssssss", $accountID, $user_owner, $hashed_password, $accType, $status, $approval, $question, $answer);

    if ($stmt_account->execute()) {
        // Get the inserted account ID
        $account_id = $stmt_account->insert_id;

        // Insert into owners table
        $stmt_owner = $conn->prepare("INSERT INTO owner (OwnerID, FullName, Lastn_owner, ContNum, fblink, Address, Email, L_Name, L_Email, L_Num, AccountID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_owner->bind_param("sssssssssss", $ownerID, $name_owner, $Lastn_owner, $cont_owner, $fblink, $add_owner, $email_owner, $name_land, $email_land, $cont_land, $accountID);

        if ($stmt_owner->execute()) {
            // Process uploaded images
            if (!empty($_FILES['files']['name'][0])) {
                $files = $_FILES['files'];
                $file_count = count($files['name']);

                // Directory where files will be uploaded
                $upload_dir = "../permits/".$ownerID."/";

                // Check if directory exists, create it if not
                if (!is_dir($upload_dir)) {
                    if (!mkdir($upload_dir, 0755, true)) { // 0755 is the default permission for directories
                        die("Failed to create directory: " . $upload_dir);
                    }
                } 

                // Loop through each file
                for ($i = 0; $i < $file_count; $i++) {
                    $file_name = $files['name'][$i];
                    $file_type = $files['type'][$i];
                    $file_tmp = $files['tmp_name'][$i];
                    $file_size = $files['size'][$i];

                    // Generate unique file ID
                    $fileID = fileID($conn);

                    // Generate unique file name to prevent overwriting
                    $unique_filename = uniqid() . "_" . $file_name;
                    $file_path = $upload_dir . $unique_filename;

                    // Move uploaded file to upload directory
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        // Insert file details into database
                        $stmt_file = $conn->prepare("INSERT INTO permit (FileID, File_Name, File_Type, File_Path, OwnerID) VALUES (?, ?, ?, ?, ?)");
                        $stmt_file->bind_param("sssss", $fileID, $file_name, $file_type, $file_path, $ownerID);
                        $stmt_file->execute();
                        $stmt_file->close();
                    } else {
                        $_SESSION['error_message'] = "Uploading file failed.";
                    }
                }
            }
            $_SESSION['success_message'] = "Sign up successful!";
        } else {
            $_SESSION['error_message'] = "Sign up failed.";
        }

        $stmt_owner->close();
    } else {
        $_SESSION['error_message'] = "Sign up failed.";
    }
    $stmt_account->close();
}
header("Location: ../signup_owner.php");
exit;
$conn->close();
?>
