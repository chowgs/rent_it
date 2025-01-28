<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

function generatePropertyID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM property WHERE PropertyID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

function generateRoomID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM room WHERE RoomID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $accountId = $_SESSION['AccountID'];
    $propertyID = generatePropertyID($conn);
    // Get property details from the form
    $location = $_POST['location'];
    $cat = $_POST['cat'];
    $type = $_POST['type'];
    $totalRooms = $_POST['totalRooms'];
    $desc = $_POST['description'];

    // Get owner_id from owner table using account_id
    $ownerQuery = "SELECT OwnerID FROM owner WHERE AccountID = ?";
    $stmtOwner = $conn->prepare($ownerQuery);
    $stmtOwner->bind_param("s", $accountId);
    $stmtOwner->execute();
    $result = $stmtOwner->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ownerId = $row['OwnerID']; 

        // Handle file upload for images
        $imageLinks = [];
        if (!empty($_FILES['files']['name'][0])) {
            $file_count = count($_FILES['files']['name']);
            $upload_message = ''; // Initialize upload message
        
            for ($i = 0; $i < $file_count; $i++) {
                $file_name = $_FILES['files']['name'][$i];
                $file_tmp = $_FILES['files']['tmp_name'][$i];
                $file_error = $_FILES['files']['error'][$i];

                // Check if there was an error uploading the file
                if ($file_error !== UPLOAD_ERR_OK) {
                    $upload_message .= "File upload error for file $file_name.<br>";
                } else {
        
                    // Generate unique filename to prevent overwriting
                    $generated_filename = uniqid() . '_' . $file_name;

                    $path = "../../gallery/" .$ownerId. "/";
                    $dir = "../../gallery/" .$ownerId. "/" .$generated_filename;
                    $upload_dir = "../gallery/" .$ownerId. "/" .$generated_filename;

                    // Check if directory exists, create it if not
                    if (!is_dir($path)) {
                        if (!mkdir($path, 0755, true)) { // 0755 is the default permission for directories
                            die("Failed to create directory: " . $path);
                        }
                    }
                    // Move the uploaded file to the upload directory
                    if (move_uploaded_file($file_tmp, $dir)) {
                        $imageLinks[] = $upload_dir;
                    }else {
                        $_SESSION['error_message'] = "Uploading gallery failed.";
                        echo "error";
                        exit;
                    }
                }
            }
        }else{
            $_SESSION['error_message'] = "No files recieved.";
            echo "error";
            exit;
        }

        // Convert array of image links to comma-separated string
        $imageLinksString = implode(",", $imageLinks);
        
        if(!empty($location)){
            // Insert property details into the property table
            $propertyQuery = "INSERT INTO property (PropertyID, Type, Category, Location, Total_Room, ImgURL,  OwnerID, Description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($propertyQuery);
            $stmt->bind_param("ssssisss", $propertyID, $type, $cat, $location, $totalRooms, $imageLinksString,  $ownerId, $desc);

            // Close the statement for owner query
            $stmtOwner->close();

            if ($stmt->execute()) {

                // Loop through each room and insert details into the room table
                for ($i = 1; $i <= $totalRooms; $i++) {
                    $roomFloor = $_POST["roomFloor$i"];
                    $roomNumber = $_POST["roomNumber$i"];
                    $kitchen = $_POST["kitchen$i"];
                    $livingRoom = $_POST["livingRoom$i"];
                    $bed = !empty($_POST["bed$i"]) ? $_POST["bed$i"] : null;
                    $rest = !empty($_POST["restroom$i"]) ? $_POST["restroom$i"] : '0';
                    $status = "Vacant";
                    $roomID = generateRoomID($conn);

                    $roomQuery = "INSERT INTO room (RoomID, Room_Flr, Room_No, Bed, Kitchen, Liv_Room, Rest_Room, Status, PropertyID, OwnerID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($roomQuery);
                    $stmt->bind_param("ssssssssss", $roomID, $roomFloor, $roomNumber, $bed, $kitchen, $livingRoom, $rest, $status, $propertyID, $ownerId);

                    if (!$stmt->execute()) {
                        $_SESSION['error_message'] = "Inserting to room table failed.";
                        echo "error";
                        exit;
                    }
                }

                $_SESSION['success_message'] = "Property added successfully.";
                echo "success";
            } else {
                $_SESSION['error_message'] = "Adding property failed.";
                echo "error";
            }
            $stmt->close();
        }else {
            $_SESSION['error_message'] = "Location is empty.";
            echo "error";
        }

    } else {
        // Handle case where no owner is found for the account_id (this should not happen ideally)
        $_SESSION['error_message'] = "No owner id found.";
        echo "error";
    }
    $stmtOwner->close();
    $conn->close();
} else {
    $_SESSION['error_message'] = "Invalid request method.";
    echo "error";
}
exit;
?>

