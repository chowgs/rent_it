<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

function generateID($conn, $length = 8) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    do {
        $scrambledId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $scrambledId .= $characters[$randomIndex];
        }
        // Check if the generated ID already exists in the database
        $checkQuery = "SELECT COUNT(*) AS count FROM reviews WHERE ReviewID = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $scrambledId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];
        $checkStmt->close();
    } while ($count > 0); // Keep generating until a unique ID is found
    return $scrambledId;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $propertyID = $_POST['propertyID'];
    $boarderID = $_POST['boarderID'];
    $message = $_POST['message'];
    
    // Check if a review already exists for the given boarderID and propertyID
    $checkQuery = "SELECT COUNT(*) AS count FROM reviews WHERE PropertyID = ? AND BoarderID = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("ss", $propertyID, $boarderID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $count = $checkResult->fetch_assoc()['count'];
    $checkStmt->close();

    if ($count > 0) {
        // Review already exists
        $_SESSION['error_message'] = "You have already submitted a review for this property.";
    } else {
        // Proceed with inserting the new review
        $id = generateID($conn);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO reviews (ReviewID, Review, RevDate, PropertyID, BoarderID) VALUES (?, ?, Now(), ?, ?)");
        $stmt->bind_param("ssss", $id, $message, $propertyID, $boarderID);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a success page or show a success message
            $_SESSION['success_message'] = "Review submitted successfully.";
        } else {
            // Show an error message
            $_SESSION['error_message'] = "Failed to submit a review."; 

        }
     
    }

}
header("Location: ../property_detail.php?id=" . $propertyID);
exit;   
$stmt->close();
$conn->close();
?>
