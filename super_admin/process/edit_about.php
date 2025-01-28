<?php
session_start();
require_once("../../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $about = !empty($_POST["about"]) ? $_POST["about"] : null;    
    
    // Check if the info table has any rows
    $check_sql = "SELECT COUNT(*) FROM info";
    $check_result = $conn->query($check_sql);
    $row = $check_result->fetch_row();
    $count = $row[0];
    
    if ($count > 0) {
        // Update owner table if rows exist
        $sql = "UPDATE info SET About = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $about);
    } else {
        // Insert into owner table if no rows exist
        $sql = "INSERT INTO info (About) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$about);
    }
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Information updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error updating Information.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: ../about.php");
exit;
?>
