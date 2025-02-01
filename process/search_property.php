<?php
require_once("../config/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $location = $_POST['location'];
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $itemsPerPage = isset($_POST['itemsPerPage']) ? (int)$_POST['itemsPerPage'] : 6;
    $offset = ($page - 1) * $itemsPerPage;

    // Query to fetch properties along with the owner's name and checking the owner's status
    $query = "SELECT property.*, owner.FullName AS name 
              FROM property 
              JOIN owner ON property.OwnerID = owner.OwnerID 
              JOIN account ON owner.AccountID = account.AccountID 
              WHERE account.Status = '1' AND Location LIKE ? AND (Type = ? OR ? = '') 
              LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $searchLocation = "%$location%";
    $stmt->bind_param("sssss", $searchLocation, $type, $type, $offset, $itemsPerPage);
    $stmt->execute();
    $result = $stmt->get_result();
    $properties = $result->fetch_all(MYSQLI_ASSOC);

    // Fetch total number of properties for pagination
    $countQuery = "SELECT COUNT(*) AS total 
                   FROM property 
                   JOIN owner ON property.OwnerID = owner.OwnerID 
                   JOIN account ON owner.AccountID = account.AccountID 
                   WHERE account.Status = '1' AND Location LIKE ? AND (Type = ? OR ? = '')";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param("sss", $searchLocation, $type, $type);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalProperties = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalProperties / $itemsPerPage);

    if ($properties) {
        foreach ($properties as $property) {
            // Split the image URL string by commas and get the first URL
            $imageUrls = explode(',', $property['ImgURL']);
            $firstImageUrl = str_replace('../', '', $imageUrls[0]);

            $kitchen = 0;
            $liv = 0;
            $cr = 0;
            $bed = 0;
            // Fetch all rooms for this property
            $roomsQuery = "SELECT * FROM room WHERE PropertyID = ?";
            $roomsStmt = $conn->prepare($roomsQuery);
            $roomsStmt->bind_param("s", $property['PropertyID']);
            $roomsStmt->execute();
            $roomsResult = $roomsStmt->get_result();
            $rooms = $roomsResult->fetch_all(MYSQLI_ASSOC);
  
            if ($rooms) {
                foreach ($rooms as $room) {
                    $kitchen += intval($room['Kitchen']);
                    $liv += intval($room['Liv_Room']);
                    $cr += intval($room['Rest_Room']);
                    $bed += intval($room['Bed']);
                }
            } 

            echo '<div class="col-md-4">';
            echo '<div class="property-card">';
            echo '<a href="property_detail.php?id=' . htmlspecialchars($property['PropertyID']) . '">';
            // echo '<img class="image-card" src="' . htmlspecialchars($firstImageUrl) . '" alt="Property Image" style="width:100%; height: 220px;">';
            
            echo '<div class="txt">';
            echo '<p onclick="openDirections(\'' . htmlspecialchars($property['Location']) . '\')"><ion-icon class="icon" name="location"></ion-icon>' . htmlspecialchars($property['Location']) . '</p>';
            echo '</div>';
            echo '<table>';
            echo '<tbody>';
            echo '<tr>';
            echo '<td>'.$property['Total_Room'].'</td>';
            echo '<td>'.$bed.'</td>';
            echo '<td>'.$kitchen.'</td>';
            echo '<td>'.$liv.'</td>';
            echo '<td>'.$cr.'</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Rooms</td>';
            echo '<td>Beds</td>';
            echo '<td>Kitchen</td>';
            echo '<td>Living Room</td>';
            echo '<td>Rest Room</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '<div class="txtt">';
            echo '<p>Owner: ' . htmlspecialchars($property['name']) . '</p>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12"><p>No properties found.</p></div>';
    }
    echo "<script>var totalPages = $totalPages;</script>";
}
?>
