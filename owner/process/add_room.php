<?php
session_start();

// Include your database connection file
require_once("../../config/connect.php");

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

// Ensure that the POST request contains the necessary data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['totalRooms'])) {
    $totalRooms = intval($_POST['totalRooms']);
    $accountID = $_SESSION['AccountID'];
    $propertyID = $_POST['propid']; // Assuming you have a propertyID in your form

    // Fetch ownerID from the owner table
    $fetchOwnerSQL = "SELECT ownerID FROM owner WHERE AccountID = ?";
    $stmtFetchOwner = $conn->prepare($fetchOwnerSQL);
    if ($stmtFetchOwner === false) {
        echo json_encode(["error" => "Failed to prepare fetch owner statement"]);
        exit();
    }

    $stmtFetchOwner->bind_param("s", $accountID);
    $stmtFetchOwner->execute();
    $resultFetchOwner = $stmtFetchOwner->get_result();

    if ($resultFetchOwner->num_rows === 0) {
        echo json_encode(["error" => "No owner found for this accountID"]);
        exit();
    }

    $owner = $resultFetchOwner->fetch_assoc();
    $ownerID = $owner['ownerID'];
    
    $stmtFetchOwner->close();

    // Fetch the current total number of rooms for the property
    $fetchPropertySQL = "SELECT Total_Room FROM property WHERE PropertyID = ?";
    $stmtFetchProperty = $conn->prepare($fetchPropertySQL);
    if ($stmtFetchProperty === false) {
        echo json_encode(["error" => "Failed to prepare fetch property statement"]);
        exit();
    }

    $stmtFetchProperty->bind_param("s", $propertyID);
    $stmtFetchProperty->execute();
    $resultFetchProperty = $stmtFetchProperty->get_result();

    if ($resultFetchProperty->num_rows === 0) {
        echo json_encode(["error" => "No property found with this PropertyID"]);
        exit();
    }

    $property = $resultFetchProperty->fetch_assoc();
    $currentTotalRooms = intval($property['Total_Room']);
    $newTotalRooms = $currentTotalRooms + $totalRooms;
    $stmtFetchProperty->close();

    // Update the property table with the new total number of rooms and ownerID
    $updatePropertySQL = "UPDATE property SET Total_Room = ? WHERE PropertyID = ? AND OwnerID = ?";
    $stmtUpdateProperty = $conn->prepare($updatePropertySQL);
    if ($stmtUpdateProperty === false) {
        $_SESSION['error_message'] = "Failed to prepare statement for property.";
        exit();
    }

    $stmtUpdateProperty->bind_param("iss", $newTotalRooms, $propertyID, $ownerID);
    $stmtUpdateProperty->execute();

    if ($stmtUpdateProperty->affected_rows <= 0) {
        $_SESSION['error_message'] = "Failed to update property.";
        exit();
    }

    // Insert room details into the room table
    $roomErrors = [];
    for ($i = 1; $i <= $totalRooms; $i++) {
        $roomID = generateRoomID($conn);
        $roomFloor = $_POST["roomFloor$i"];
        $roomNumber = $_POST["roomNumber$i"];
        $bed = $_POST["bed$i"];
        $restroom = $_POST["restroom$i"];
        $kitchen = $_POST["kitchen$i"];
        $livingRoom = $_POST["livingRoom$i"];

        $insertRoomSQL = "INSERT INTO room (RoomID, Room_Flr, Room_No, Bed, Rest_Room, Kitchen, Liv_Room, Status, PropertyID, OwnerID) VALUES (?, ?, ?, ?, ?, ?, ?, 'Vacant', ?, ?)";
        $stmtInsertRoom = $conn->prepare($insertRoomSQL);

        if ($stmtInsertRoom === false) {
            $roomErrors[] = "Failed to prepare insert statement for room $i";
            continue;
        }

        $stmtInsertRoom->bind_param("sssssssss", $roomID , $roomFloor, $roomNumber, $bed, $restroom, $kitchen, $livingRoom, $propertyID, $ownerID);
        $stmtInsertRoom->execute();

        if ($stmtInsertRoom->affected_rows <= 0) {
            $_SESSION['error_message'] = "Error inserting room: " . $conn->error;
        }

        $stmtInsertRoom->close();
    }

    if (!empty($roomErrors)) {
        $_SESSION['error_message'] = "Error adding room: " . $conn->error;
    } else {
        $_SESSION['success_message'] = "Room added successfully.";
    }

    $stmtUpdateProperty->close();
    $conn->close();
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

header("Location: ../property.php");
exit;
?>
