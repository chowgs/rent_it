<?php
/*
session_start();
require_once("../../config/connect.php");

if(isset($_POST['roomID'])){
    $roomID = $_POST['roomID'];
    $roomNo = $_POST['roomNo'];
    $roomFloor = $_POST['roomFloor'];
    $bed = $_POST['bed'];
    $restroom = $_POST['restRoom'];
    $kitchen = $_POST['kitchen'];
    $livingRoom = $_POST['livingRoom'];
    $roomPicture = $_POST['roomPicture'];

    $roomImageURL = ""; // Default empty

    $sql = "UPDATE room SET Room_No = ?, Room_Flr = ?, Bed = ?, Rest_Room = ?, Kitchen = ?, Liv_Room = ? WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $roomNo, $roomFloor, $bed, $restroom, $kitchen, $livingRoom, $roomID);

    if($stmt->execute()){
        $_SESSION['success_message'] = "Room updated successfully.";
        echo "success";
        exit;
    } else {
        $_SESSION['error_message'] = "Updating room failed.";
        echo "error";
        exit;
    }

    $stmt->close();
    $conn->close();
}
*/

session_start();
require_once("../../config/connect.php"); // Ensure your database connection is included

if (isset($_POST['roomID'])) {
    $roomID = $_POST['roomID'];
    $roomNo = $_POST['roomNo'];
    $roomFloor = $_POST['roomFloor'];
    $bed = $_POST['bed'];
    $restroom = $_POST['restRoom'];
    $kitchen = $_POST['kitchen'];
    $livingRoom = $_POST['livingRoom'];
    
    // File Upload Handling
    $roomImageURL = ""; // Default empty
    if(isset($_FILES['roomPicture']) && $_FILES['roomPicture']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileTmpPath = $_FILES['roomPicture']['tmp_name'];
        $fileName = basename($_FILES['roomPicture']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if(in_array($fileExt, $allowedExtensions)){
            $uploadDir = "../../images/" . $roomID . "/"; // Root directory
            $relativePath = "images/" . $roomID . "/"; // Relative path for database

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
            }

            $newFileName = uniqid() . "." . $fileExt; // Generate unique filename
            $destinationPath = $uploadDir . $newFileName;
            $roomImageURL = $relativePath . $newFileName; // Store relative path in DB

            if (!move_uploaded_file($fileTmpPath, $destinationPath)) {
                $_SESSION['error_message'] = "Image upload failed.";
                echo "error";
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Invalid file format. Only JPG, JPEG, PNG, and GIF allowed.";
            echo "error";
            exit;
        }
    } else {
        $_SESSION['error_message'] = "NO SESSION";
        echo "NO SESSION";
        exit;
    }

    // If no new image is uploaded, keep the old one
    if ($roomImageURL == "") {
        $sql = "SELECT RoomImageURL FROM room WHERE RoomID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $roomID);
        $stmt->execute();
        $stmt->bind_result($existingImageURL);
        $stmt->fetch();
        $stmt->close();
        $roomImageURL = $existingImageURL;
    }

    // Update Room Details
    $sql = "UPDATE room SET Room_No = ?, Room_Flr = ?, Bed = ?, Rest_Room = ?, Kitchen = ?, Liv_Room = ?, RoomImageURL = ? WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $roomNo, $roomFloor, $bed, $restroom, $kitchen, $livingRoom, $roomImageURL, $roomID);

    if($stmt->execute()){
        $_SESSION['success_message'] = "Room updated successfully.";
        echo "success";
    } else {
        $_SESSION['error_message'] = "Updating room failed.";
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>