<?php
session_start();
require_once("../../config/connect.php");

function generateFileID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM permit WHERE FileID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

if (!empty($_FILES['files']['name'][0])) {
    $accountID = $_SESSION['AccountID'];

    $id = "SELECT OwnerID FROM owner WHERE AccountID = ?";
    $idstmt = $conn->prepare($id);
    $idstmt->bind_param("s", $accountID); // Bind $accountID as a string parameter
    
    // Execute the query
    $idstmt->execute();
    
    // Get the result
    $idresult = $idstmt->get_result();
    
    // Check if there is a row returned
    if ($idresult->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $idresult->fetch_assoc();
        $ownerID = $row['OwnerID'];
    } else {
        $_SESSION['error_message'] = "No OwnerID found.";
    }
    $file_count = count($_FILES['files']['name']);
    $upload_message = ''; // Initialize upload message

    for ($i = 0; $i < $file_count; $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $file_error = $_FILES['files']['error'][$i];

        // Check if there was an error uploading the file
        if ($file_error !== UPLOAD_ERR_OK) {
            $upload_message .= "File upload error for file $file_name.<br>";
        } else {
            // Generate unique file ID
            $fileID = generateFileID($conn);

            // Generate unique filename to prevent overwriting
            $generated_filename = uniqid() . '_' . $file_name;
            $dirr = "../../permits/" .$ownerID. "/"; 
            $dir = "../../permits/" .$ownerID. "/" .$generated_filename;
            $upload_dir = "../permits/" .$ownerID. "/" .$generated_filename;

// Check if directory exists, create it if not

if (!is_dir($dirr)) {

    if (!mkdir($dirr, 0755, true)) { // 0755 is the default permission for directories
    
    }
}

            // Move the uploaded file to the upload directory
            if (move_uploaded_file($file_tmp, $dir)) {
                // Insert into permit table
                $sql_insert_permit = "INSERT INTO permit (FileID, File_Name, File_Type, File_Path, OwnerID) VALUES (?, ?, ?, ?, ?)";
                $stmt_insert_permit = $conn->prepare($sql_insert_permit);
                $stmt_insert_permit->bind_param("sssss", $fileID, $file_name, $file_type, $upload_dir, $ownerID);

                if ($stmt_insert_permit->execute()) {
                    $_SESSION['success_message'] = "File uploaded successfully.";

                } else {
                    $_SESSION['error_message'] = "Error inserting file into database: " . $conn->error;

                }

                $stmt_insert_permit->close();
            } else {
                $_SESSION['error_message'] = "Error moving uploaded file.";
            }
        }
    }
} else {
    $accountID = $_SESSION["AccountID"];
    $fullName = $_POST["FullName"];
    $contNum = $_POST["ContNum"];
    $address = $_POST["Address"];
    $email = $_POST["Email"];
    
    // Check if optional fields are set
    $lName = isset($_POST["L_Name"]) ? $_POST["L_Name"] : '';
    $lNum = isset($_POST["L_Num"]) ? $_POST["L_Num"] : '';
    $lEmail = isset($_POST["L_Email"]) ? $_POST["L_Email"] : '';
    
    // Update owner table
    $sql = "UPDATE owner SET FullName = ?, ContNum = ?, Address = ?, Email = ?, L_Name = ?, L_Num = ?, L_Email = ? WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $fullName, $contNum, $address, $email, $lName, $lNum, $lEmail, $accountID);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error updating profile.";
    }
}
header("Location: ../profile.php");
exit;
$stmt->close();
$conn->close();

?>
