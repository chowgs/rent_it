<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $propertyID = $_POST['id'];
    $accountID = $_SESSION['AccountID'];

    // Fetch BoarderID using AccountID
    $boarderID = '';
    $boarderSql = "SELECT BoarderID FROM boarder WHERE AccountID = ?";
    $boarderStmt = $conn->prepare($boarderSql);
    $boarderStmt->bind_param("s", $accountID);
    $boarderStmt->execute();
    $boarderResult = $boarderStmt->get_result();

    if ($boarderResult->num_rows > 0) {
        $boarderRow = $boarderResult->fetch_assoc();
        $boarderID = $boarderRow['BoarderID'];
    }

    $boarderStmt->close();

    // Fetch rooms based on the property ID
    $sql = "SELECT r.*, b.BoarderID
            FROM room r
            LEFT JOIN booking b ON r.RoomID = b.RoomID AND b.BoarderID = ?
            WHERE r.PropertyID = ? AND r.Status = 'Vacant'
            ORDER BY CAST(Room_No AS UNSIGNED)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $boarderID, $propertyID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row["Room_No"]."</td>";
            echo "<td>".$row["Room_Flr"]."</td>";
            echo "<td>".$row["Bed"]."</td>";
            echo "<td>".$row["Kitchen"]."</td>";
            echo "<td>".$row["Liv_Room"]."</td>";
            echo "<td>".$row["Rest_Room"]."</td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No rooms found for this property.</td></tr>";
    }

    $stmt->close();
    $conn->close();
}
?>
