<?php
require_once("../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['propertyId'], $_POST['status'])) {
    $propertyId = intval($_POST['propertyId']);
    $status = intval($_POST['status']); // 1 for favorite, 0 for unfavorite

    $query = "UPDATE property SET Favorite = ? WHERE PropertyID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $status, $propertyId);
    $stmt->execute();

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
?>
