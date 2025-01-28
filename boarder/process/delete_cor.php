<?php
// Include your database connection file
require_once("../../config/connect.php");

if (isset($_POST['boarderID'])) {
    $boarderID = $_POST['boarderID'];
    $cor = null;

    // First, retrieve the file path from the database
    $sql_select_file = "SELECT COR FROM boarder WHERE BoarderID = '$boarderID'";
    $result = $conn->query($sql_select_file);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = "../" .$row['COR'];

        // Delete the file from the server
        if (unlink($file_path)) { // unlink() deletes the file
            // File deleted successfully, now delete from database
            $update = "UPDATE boarder SET COR = ? WHERE BoarderID = ?";
            $updatestmt = $conn->prepare($update);
            $updatestmt->bind_param("ss", $cor, $boarderID);
            
            if ($updatestmt->execute()) {
                echo 'success';
            } else {
                echo 'error updating from database';
            }
        } else {
            echo 'error deleting file';
        }
    } else {
        echo 'file not found in database';
    }
} else {
    echo 'invalid boarderID';
}
?>
