<?php
session_start();
require_once("../../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p = !empty($_POST["p"]) ? $_POST["p"] : null;
    $fb = !empty($_POST["fb"]) ? $_POST["fb"] : null;
    $cont = !empty($_POST["cont"]) ? $_POST["cont"] : null;
    $add = !empty($_POST["address"]) ? $_POST["address"] : null;
    $gm = !empty($_POST["gmail"]) ? $_POST["gmail"] : null;        
    
    // Check if the info table has any rows
    $check_sql = "SELECT COUNT(*) FROM info";
    $check_result = $conn->query($check_sql);
    $row = $check_result->fetch_row();
    $count = $row[0];
    
    if ($count > 0) {
        // Update owner table if rows exist
        $sql = "UPDATE info SET P = ?, FB = ?, ContNum = ?, Address = ?, Gmail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $p, $fb, $cont, $add, $gm);
    } else {
        // Insert into owner table if no rows exist
        $sql = "INSERT INTO info (P, FB, ContNum, Address, Gmail) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $p, $fb, $cont, $add, $gm);
    }
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Information updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error updating Information.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: ../contact.php");
exit;
?>
