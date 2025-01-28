<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

// Ensure the account ID is set in the session
if(isset($_SESSION['AccountID']) && isset($_POST['permitID']) && isset($_POST['imgURL'])){
    $accountID = $_SESSION['AccountID'];
    $propertyID = $_POST['permitID'];
    $imgURL = $_POST['imgURL'];
    
    // Fetch the OwnerID using the AccountID
    $ownerSql = "SELECT OwnerID FROM owner WHERE AccountID = ?";
    $ownerStmt = $conn->prepare($ownerSql);
    $ownerStmt->bind_param("s", $accountID);
    $ownerStmt->execute();
    $ownerResult = $ownerStmt->get_result();

    if($ownerResult->num_rows > 0){
        $ownerRow = $ownerResult->fetch_assoc();
        $ownerID = $ownerRow['OwnerID'];

        // Fetch the current image URLs
        $sql = "SELECT ImgURL FROM property WHERE PropertyID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $propertyID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $imgURLs = explode(',', $row['ImgURL']);

            // Remove the specified image URL
            $imgURLs = array_filter($imgURLs, function($url) use ($imgURL) {
                return trim($url) != $imgURL;
            });

            // Update the database with the new image URLs
            $newImgURLs = implode(',', $imgURLs);
            $updateSql = "UPDATE property SET ImgURL = ? WHERE PropertyID = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $newImgURLs, $propertyID);

            if($updateStmt->execute()){
                // Delete the image file from the local filesystem
                $imageDirectory = '../../gallery/'.$ownerID.'/';
                $imagePath = $imageDirectory . basename($imgURL);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                echo 'success';
            } else {
                echo 'error';
            }

            $updateStmt->close();
        } else {
            echo 'error';
        }

        $stmt->close();
    } else {
        echo 'error';
    }

    $ownerStmt->close();
    $conn->close();
} else {
    echo 'error';
}
?>
