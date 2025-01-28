<?php
session_start();
require_once("../../config/connect.php");

if (isset($_FILES['images']) && isset($_POST['propertyID'])) {
    $propertyID = $_POST['propertyID'];
    $accountId = $_SESSION['AccountID'];

    $ownerQuery = "SELECT OwnerID FROM owner WHERE AccountID = ?";
    $stmtOwner = $conn->prepare($ownerQuery);
    $stmtOwner->bind_param("s", $accountId);
    $stmtOwner->execute();
    $result = $stmtOwner->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ownerId = $row['OwnerID']; 
        
        $uploadDirectory = "../gallery/" .$ownerId. "/";
        $path = "../../gallery/" .$ownerId. "/";
        $uploadedFiles = [];
        
        // Ensure the upload directory exists
        if (!is_dir($path)) {
            if (!mkdir($path, 0755, true)) { // 0755 is the default permission for directories
                die("Failed to create directory: " . $path);
            }
        }

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $filePath = $uploadDirectory . $fileName;
            $filepath = $path . $fileName;

            if (move_uploaded_file($tmpName, $filepath)) {
                $uploadedFiles[] = $filePath;
            }
        }

        if (!empty($uploadedFiles)) {
            $uploadedFilesString = implode(',', $uploadedFiles);

            // Get current ImgURL
            $sql = "SELECT ImgURL FROM property WHERE PropertyID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $propertyID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentImgURL = $row['ImgURL'];

                if (!empty($currentImgURL)) {
                    $updatedImgURL = $currentImgURL . ',' . $uploadedFilesString;
                } else {
                    $updatedImgURL = $uploadedFilesString;
                }

                // Update ImgURL in the property table
                $updateSQL = "UPDATE property SET ImgURL = ? WHERE PropertyID = ?";
                $updateStmt = $conn->prepare($updateSQL);
                $updateStmt->bind_param("ss", $updatedImgURL, $propertyID);

                if ($updateStmt->execute()) {
                    $_SESSION['success_message'] = "Images uploaded and property updated successfully.";
                } else {
                    $_SESSION['error_message'] = "Failed to update property with new images.";
                }

                $updateStmt->close();
            } else {
                $_SESSION['error_message'] = "Property not found.";
            }

            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Failed to upload images.";
        }
    } else {
        $_SESSION['error_message'] = "No images or property ID provided.";
    }
}

header("Location: ../property.php");
exit;

$conn->close();
?>
