<?php
session_start();
require_once("../../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_SESSION['AccountID'];
    $question = !empty($_POST["question"]) ? $_POST["question"] : null;   
    $answer = !empty($_POST["answer"]) ? $_POST["answer"] : null;     
    
    // Update owner table if rows exist
    $sql = "UPDATE account SET SQuestion = ?, Answer = ? WHERE AccountID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $question, $answer, $accountID);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Security updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error updating security.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: ../profile.php");
exit;
?>
