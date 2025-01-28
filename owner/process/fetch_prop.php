<?php
session_start();

// Include your database connection file
require_once("../../config/connect.php");

// Set the content type to JSON
header('Content-Type: application/json');

// Start output buffering
ob_start();

if (isset($_POST['propertyID'])) {
    $propertyID = $_POST['propertyID'];

    // Fetch property details based on the property ID
    $sql = "SELECT * FROM property WHERE PropertyID = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["error" => "Failed to prepare statement"]);
        ob_end_flush();
        exit();
    }

    $stmt->bind_param("s", $propertyID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $property = $result->fetch_assoc();

        // Fetch the ImgURL field
        $imgURLs = $property['ImgURL']; // Adjust the field name based on your database schema

        if ($imgURLs) {
            $images = explode(',', $imgURLs);
        } else {
            $images = [];
        }

        $property['images'] = $images;

        // Clean the output buffer before sending JSON response
        ob_clean();
        echo json_encode($property);
    } else {
        // Clean the output buffer before sending JSON response
        ob_clean();
        echo json_encode(["error" => "No property found with this ID."]);
    }

    $stmt->close();
    $conn->close();
} else {
    // Clean the output buffer before sending JSON response
    ob_clean();
    echo json_encode(["error" => "Property ID is missing."]);
}

// End and clean the output buffer
ob_end_flush();
?>
