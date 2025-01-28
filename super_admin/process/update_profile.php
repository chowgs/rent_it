<?php
session_start();
require_once("../../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_SESSION["AccountID"];
    $fullName = $_POST["FullName"];
    $contNum = $_POST["ContNum"];
    $email = $_POST["Email"];
    
    // Update owner table
    $sql = "UPDATE admin SET FullName = ?, ContNum = ?, Email = ? WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullName, $contNum, $email, $accountID);
    
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
