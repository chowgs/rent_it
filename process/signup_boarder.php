<?php
session_start();
require_once("../config/connect.php");
require_once("./sendEmail.php");

function generateToken($length = 32) {
    return bin2hex(random_bytes($length));  // Generate a unique token
}

function accountID($conn, $length = 8) {
    $characters = '0123456789';
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
    $characters = '0123456789';
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
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
    $repword = $_POST['repword'];
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

    // Validate required fields
    if (empty($name) || empty($lname) || empty($mname) || empty($uname) || empty($pword) || empty($email)) {
        $_SESSION['error_message'] = "Please fill all required fields.";
        header("Location: ../signup_boarder.php");
        exit;
    }

    if ($pword !== $repword) {
        $_SESSION['error_message'] = "Password does not match";
        header("Location: ../signup_boarder.php");
        exit;
    }

    // Check if the username already exists
    $check_username_query = "SELECT COUNT(*) AS count FROM account WHERE UName = ?";
    $stmt_check_username = $conn->prepare($check_username_query);
    $stmt_check_username->bind_param("s", $uname);
    $stmt_check_username->execute();
    $result_check_username = $stmt_check_username->get_result();
    $username_count = $result_check_username->fetch_assoc()['count'];

    if ($username_count > 0) {
        $_SESSION['error_message'] = "Username already exists. Please choose a different username.";
        header("Location: ../signup_boarder.php");
        exit;
    }
    $stmt_check_username->close();

    // Generate account and boarder IDs
    $accountID = accountID($conn);
    $boarderID = boarderID($conn);

    // Handle file upload
    $upload_dir = "../cor/" . $boarderID . "/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $unique_filename = uniqid() . "_" . $file_name;
    $file_path = $upload_dir . $unique_filename;

    
    move_uploaded_file($file_tmp, $file_path);

    // Set account details
    $accType = "Boarder";
    $status = "0"; // Status: Not verified
    $approval = "Approved"; // Verification pending
    $hashed_password = password_hash($pword, PASSWORD_BCRYPT);
    $verification_token = generateToken(); // Generate a verification token

    // Insert into accounts table
    $stmt_account = $conn->prepare("INSERT INTO account (AccountID, UName, PWord, AccType, Status, Approval, SQuestion, Answer) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_account->bind_param("ssssssss", $accountID, $uname, $hashed_password, $accType, $status, $approval, $question, $answer);

    if ($stmt_account->execute()) {
        
        $stmt_boarder = $conn->prepare("INSERT INTO boarder (BoarderID, FullName, LastName, MiddleName, Contact_No, YearLvl, Course, Email, COR, M_Name, F_Name, M_Cont, F_Cont, AccountID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_boarder->bind_param("ssssssssssssss", $boarderID, $name, $lname, $mname, $contact, $year, $course, $email, $file_path, $mother, $father, $m_cont, $f_cont, $accountID);

        if ($stmt_boarder->execute()) {
            // Send verification email using PHPMailer
            try {
                registerSendEmail("Boarder", $email);
                $_SESSION['success_message'] = "Signup successfully, please check your email";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Verification email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $_SESSION['error_message'] = "Boarder insertion failed. Error: " . $stmt_boarder->error;
        }

        $stmt_boarder->close();
    } else {
        $_SESSION['error_message'] = "Account insertion failed. Error: " . $stmt_account->error;
    }

    $stmt_account->close();
}

header("Location: ../signup_boarder.php");
exit;
$conn->close();
?>
