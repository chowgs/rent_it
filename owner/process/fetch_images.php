<?php
session_start(); // Start the session

// Include your database connection file
require_once("../../config/connect.php");

if(isset($_POST['id'])){
    $propertyID = $_POST['id'];

    // Fetch image URLs based on the property ID
    $sql = "SELECT ImgURL FROM property WHERE PropertyID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $propertyID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){
            // Split the ImgURL string by commas
            $imgURLs = explode(',', $row['ImgURL']);
            foreach ($imgURLs as $imgURL) {
                // Trim any whitespace and display each image
                $imgURL = trim($imgURL);
                if (!empty($imgURL)) {
                    echo '<div class="image-container">';
                    echo "<img src='".$imgURL."' alt='Property Image'>";
                    echo '<a href="#" class="delete-image delete-icon" data-image-id="'.$propertyID.'"><ion-icon name="close-circle"></ion-icon></a>';
                    echo '</div>';
                }
            }
        }
    } else {
        echo "<p>No images found for this property.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
