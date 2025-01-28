<?php
session_start();
require_once("../../config/connect.php");

if (!empty($_FILES['file'])) {
    $file = $_FILES['file'];
}

$accountID = $_SESSION['AccountID'];
$fullName = $_POST["FullName"];
$contNum = $_POST["ContNum"];
$year = $_POST["Year"];
$course = $_POST["Course"];
$email = $_POST["Email"];

// Check if optional fields are set
$mName = isset($_POST["M_Name"]) ? $_POST["M_Name"] : '';
$mNum = isset($_POST["M_Num"]) ? $_POST["M_Num"] : '';
$fName = isset($_POST["F_Name"]) ? $_POST["F_Name"] : '';
$fNum = isset($_POST["F_Num"]) ? $_POST["F_Num"] : '';

// Update boarder table
$sql = "UPDATE boarder SET FullName = ?, Contact_No = ?, YearLvl = ?, Course = ?, Email = ?, M_Name = ?, M_Cont = ?, F_Name = ?, F_Cont = ? WHERE AccountID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $fullName, $contNum, $year, $course, $email, $mName, $mNum, $fName, $fNum, $accountID);

if ($stmt->execute()) {
    $id = "SELECT * FROM boarder WHERE AccountID = ?";
    $idstmt = $conn->prepare($id);
    $idstmt->bind_param("s", $accountID);

    // Execute the query
    $idstmt->execute();

    // Get the result
    $idresult = $idstmt->get_result();

    // Check if there is a row returned
    if ($idresult->num_rows > 0) {
        $row = $idresult->fetch_assoc();
        $boarderID = $row['BoarderID'];
        $cor = "../" . $row['COR'];
    } else {
        $_SESSION['error_message'] = "No BoarderID found.";
    }

    // Check if a new file is uploaded
    if (!empty($file) && $file['error'] == UPLOAD_ERR_OK) {
        if ($cor != null && $cor != "") {
            unlink($cor); // Delete the old file
        }

        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        // Generate unique filename to prevent overwriting
        $generated_filename = uniqid() . '_' . $file_name;
        $dirr = "../../cor/" . $boarderID . "/";
        $dir = "../../cor/" . $boarderID . "/" . $generated_filename;
        $upload_dir = "../cor/" . $boarderID . "/" . $generated_filename;
        if (!is_dir($dirr)) {
            if (!mkdir($dirr, 0755, true)) { // 0755 is the default permission for directories
                die("Failed to create directory: " . $dirr);
            }
        }
        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file_tmp, $dir)) {
            $update = "UPDATE boarder SET COR = ? WHERE BoarderID = ?";
            $updatestmt = $conn->prepare($update);
            $updatestmt->bind_param("ss", $upload_dir, $boarderID);

            if ($updatestmt->execute()) {
                $_SESSION['success_message'] = "File uploaded successfully.";
            } else {
                $_SESSION['error_message'] = "Error updating file in database: " . $conn->error;
            }

            $updatestmt->close();
        } else {
            $_SESSION['error_message'] = "Error moving uploaded file.";
        }
    }

    if (!isset($_SESSION['success_message'])) {
        $_SESSION['success_message'] = "Profile updated successfully.";
    }
} else {
    $_SESSION['error_message'] = "Failed to update profile.";
}

header("Location: ../profile.php");
exit;

$stmt->close();
$conn->close();
?>
