<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $propertyID = $_POST['id'];

    $sql = "SELECT r.*
            FROM room r
            WHERE r.PropertyID = ?
            ORDER BY CAST(Room_No AS UNSIGNED)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $propertyID);
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
            $statusColor = ($row["Status"] == "Vacant") ? "gray" : "green";
            echo "<td style='color: $statusColor;'>" . $row["Status"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No rooms found for this property.</td></tr>";
    }

    $stmt->close();
    $conn->close();
}
?>
