<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['RoomID'], $_POST['PropID'], $_POST['BoarderID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $boarderID = $_POST['BoarderID'];

    // Delete the booking record from the booking table
    $deleteSql = "DELETE FROM booking WHERE RoomID = ? AND PropertyID = ? AND BoarderID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("sss", $roomID, $propID, $boarderID);

    if ($deleteStmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo 'error'; // Required parameters not set
}
?>
<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['RoomID'], $_POST['PropID'], $_POST['BoarderID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $boarderID = $_POST['BoarderID'];

    // Delete the booking record from the booking table
    $deleteSql = "DELETE FROM booking WHERE RoomID = ? AND PropertyID = ? AND BoarderID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("sss", $roomID, $propID, $boarderID);

    if ($deleteStmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo 'error'; // Required parameters not set
}
?>
<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['RoomID'], $_POST['PropID'], $_POST['BoarderID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $boarderID = $_POST['BoarderID'];

    // Delete the booking record from the booking table
    $deleteSql = "DELETE FROM booking WHERE RoomID = ? AND PropertyID = ? AND BoarderID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("sss", $roomID, $propID, $boarderID);

    if ($deleteStmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo 'error'; // Required parameters not set
}
?>
<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['RoomID'], $_POST['PropID'], $_POST['BoarderID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $boarderID = $_POST['BoarderID'];

    // Delete the booking record from the booking table
    $deleteSql = "DELETE FROM booking WHERE RoomID = ? AND PropertyID = ? AND BoarderID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("sss", $roomID, $propID, $boarderID);

    if ($deleteStmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo 'error'; // Required parameters not set
}
?>
<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['RoomID'], $_POST['PropID'], $_POST['BoarderID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $boarderID = $_POST['BoarderID'];

    // Delete the booking record from the booking table
    $deleteSql = "DELETE FROM booking WHERE RoomID = ? AND PropertyID = ? AND BoarderID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("sss", $roomID, $propID, $boarderID);

    if ($deleteStmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo 'error'; // Required parameters not set
}
?>
<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['RoomID'], $_POST['PropID'], $_POST['BoarderID'])) {
    $roomID = $_POST['RoomID'];
    $propID = $_POST['PropID'];
    $boarderID = $_POST['BoarderID'];

    // Delete the booking record from the booking table
    $deleteSql = "DELETE FROM booking WHERE RoomID = ? AND PropertyID = ? AND BoarderID = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("sss", $roomID, $propID, $boarderID);

    if ($deleteStmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $deleteStmt->close();
    $conn->close();
} else {
    echo 'error'; // Required parameters not set
}
?>
