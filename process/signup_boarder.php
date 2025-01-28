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

function boarderID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM boarder WHERE BoarderID = '$scrambledId'";
        $checkResult = $conn->query($checkQuery);
        $count = $checkResult->fetch_assoc()['count'];
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}           

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
    $contact = $_POST['contact'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $mother = $_POST['mother'];
    $m_cont = $_POST['m_cont'];
    $father = $_POST['father'];
    $f_cont = $_POST['f_cont'];
    $file = $_FILES['file'];

    // Check if the username already exists
    $check_username_query = "SELECT COUNT(*) AS count FROM account WHERE UName = ?";
    $stmt_check_username = $conn->prepare($check_username_query);
    $stmt_check_username->bind_param("s", $user_owner);
    $stmt_check_username->execute();
    $result_check_username = $stmt_check_username->get_result();
    $username_count = $result_check_username->fetch_assoc()['count'];

    if ($username_count > 0) {
        $_SESSION['error_message'] = "Username already exists. Please choose a different username.";
        header("Location: ../signup_boarder.php");
        exit;
    }

    $stmt_check_username->close();

    $accountID = accountID($conn);
    $boarderID = boarderID($conn);

    $upload_dir = "../cor/".$boarderID."/";

    // Check if directory exists, create it if not
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) { // 0755 is the default permission for directories
            die("Failed to create directory: " . $upload_dir);
        }
    } 
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    // Generate unique file name to prevent overwriting
    $unique_filename = uniqid() . "_" . $file_name;
    $file_path = $upload_dir . $unique_filename; 
    move_uploaded_file($file_tmp, $file_path);


        $accType = "Boarder";
        $status = "1";
        $approval = "Approved";
        $hashed_password = password_hash($pword, PASSWORD_BCRYPT);
        // Insert into accounts table
        $stmt_account = $conn->prepare("INSERT INTO account (AccountID, UName, PWord, AccType, Status, Approval, SQuestion, Answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_account->bind_param("ssssssss", $accountID, $uname, $hashed_password, $accType, $status, $approval, $question, $answer);

        if ($stmt_account->execute()) {
            // Get the inserted account ID
            $account_id = $stmt_account->insert_id;

            // Insert into owners table
            $stmt_owner = $conn->prepare("INSERT INTO boarder (BoarderID, FullName, Contact_No, YearLvl, Course, Email, COR, M_Name, F_Name, M_Cont, F_Cont, AccountID) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_owner->bind_param("ssssssssssss", $boarderID, $name, $contact, $year, $course, $email, $file_path, $mother, $father, $m_cont, $f_cont, $accountID);

            if ($stmt_owner->execute()) {
                
                $_SESSION['success_message'] = "Sign up successful!"; 
            } else {
                $_SESSION['error_message'] = "Sign up failed.";
            }

            $stmt_owner->close();
        } else { 
            $_SESSION['error_message'] = "Sign up failed.";
        }    

}
header("Location: ../signup_boarder.php");
exit;
$conn->close();
?>
