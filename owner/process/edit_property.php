<?php
session_start();
require_once("../../config/connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_SESSION["AccountID"];
    $location = $_POST["location"];
    $cat = $_POST["cat"];
    $propertyID = $_POST["prid"];
    $desc = $_POST["description"];

    // Fetch the current password from the database
    $sql = "SELECT OwnerID FROM owner WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $accountID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($ownerID);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {

        $update_sql = "UPDATE property SET Location = ?, Category = ?, Description = ?  WHERE PropertyID = ? AND OwnerID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssss", $location, $cat, $desc, $propertyID, $ownerID);

        if ($update_stmt->execute()) {
            $_SESSION['success_message'] = "Property edited successfully.";
        } else {
            $_SESSION['error_message'] = "Error editing property: " . $conn->error;
        }

        $update_stmt->close();
    } else {
        $_SESSION['error_message'] = "OwnerID not found.";
    }
} else {
    $_SESSION['error_message'] = "User not found.";
}

header("Location: ../property.php");
exit;
$stmt->close();
$conn->close();
?>