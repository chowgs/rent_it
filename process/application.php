<?php
// Start session and require database connection
session_start();
require_once("../config/connect.php");

function appID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $scrambledId .= $characters[random_int(0, strlen($characters) - 1)];
        }
        $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM app WHERE AppID = ?");
        $stmt->bind_param("s", $scrambledId);
        $stmt->execute();
        $count = $stmt->get_result()->fetch_assoc()['count'];
        $stmt->close();
    } while ($count > 0);
    return $scrambledId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $contact = $conn->real_escape_string($_POST['cont']);
    $address = $conn->real_escape_string($_POST['add']);
    
    // Generate unique appID and folder path
    $appID = appID($conn);
    $uploadDir = realpath("../app_file/") . DIRECTORY_SEPARATOR . $appID . DIRECTORY_SEPARATOR;
    
    // Create folder if it doesn't exist
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        $_SESSION['error_message'] = "Failed to create folder for uploads.";
        header("Location: ../apply.php");
        exit();
    }
    
    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];
    $uploadedFiles = ['letapp' => '', 'picture' => '', 'bpermit' => '', 'ctc' => '', 'dti' => '', 'bfp' => '', 'bir' => '', 'rhu' => ''];

    foreach ($uploadedFiles as $inputName => &$filePath) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == 0) {
            $fileName = basename($_FILES[$inputName]['name']);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array(strtolower($fileType), $allowedTypes)) {
                $targetFilePath = $uploadDir . time() . "_" . $fileName;

                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFilePath)) {
                    chmod($targetFilePath, 0644); // Set permissions
                    $filePath = $targetFilePath; // Store the file path
                } else {
                    $_SESSION['error_message'] = "Failed to upload file: $fileName";
                    header("Location: ../apply.php");
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Invalid file type for $fileName.";
                header("Location: ../apply.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Missing or invalid file for $inputName.";
            header("Location: ../apply.php");
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO app (AppID, Name, ContNo, Address, LetApp, Picture, BPermit, CTC, DTI, BFP, BIR, RHU) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssssssss",
        $appID,
        $name,
        $contact,
        $address,
        $uploadedFiles['letapp'],
        $uploadedFiles['picture'],
        $uploadedFiles['bpermit'],
        $uploadedFiles['ctc'],
        $uploadedFiles['dti'],
        $uploadedFiles['bfp'],
        $uploadedFiles['bir'],
        $uploadedFiles['rhu']
    );

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Application submitted successfully!";
    } else {
        $_SESSION['error_message'] = "Database error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../apply.php");
    exit();
}
?>
