<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $propertyID = $_POST['id'];

    // Fetch rooms based on the property ID
    $sql = "SELECT * FROM room WHERE PropertyID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $propertyID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // Output table headers
        echo "<thead>
                  <th>Room Number</th>
                  <th>Room Floor</th>";
    
        // Check if there are rooms with beds
        $hasBeds = false;
        while($row = $result->fetch_assoc()){
            if($row["Bed"] != null){
                $hasBeds = true;
                break;
            }
        }
    
        // Conditionally add the Bed header
        if($hasBeds){
            echo "<th>Bed</th>";
        }
    
        // Continue outputting other headers
        echo "<th>Rest Room</th>
                  <th>Kitchen</th>
                  <th>Living Room</th>
                  <th>Status</th>
                  <th>Room Image</th>
                  <th>Action</th>
              </thead>";
        
        // Output table body rows
        echo "<tbody>";
        mysqli_data_seek($result, 0); // Reset result pointer
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row["Room_No"]."</td>";
            echo "<td>".$row["Room_Flr"]."</td>";
    
            // Conditionally output Bed column
            if($hasBeds){
                echo "<td>".$row["Bed"]."</td>";
            }
    
            echo "<td>".$row["Rest_Room"]."</td>";
            echo "<td>".$row["Kitchen"]."</td>";
            echo "<td>".$row["Liv_Room"]."</td>";
            echo "<td>".$row["Status"]."</td>";
            echo "<td>
                    <img src='../".$row["RoomImageURL"]."' alt='No Image' class='img-thumbnail' 
                    style='width: 50px; height: 50px; cursor: pointer;' 
                    onclick='viewImage(\"".$row["RoomImageURL"]."\")'>
                </td>";
            echo "<td>
                    <button class='btn btn-primary' data-toggle='modal' data-target='#editRoom' data-id='".$row["RoomID"]."'>Edit</button>
                    <button class='btn btn-danger' data-toggle='modal' data-target='#deleteRoom' data-id='".$row["RoomID"]."'>Delete</button>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody>";
    } else {
        echo "<p>No rooms found for this property.</p>";
    }    

    $stmt->close();
    $conn->close();
}
?>
