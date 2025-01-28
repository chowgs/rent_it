<?php
// Include your database connection file
require_once("../../config/connect.php");

if (isset($_POST['permitID'])) {
    $permitID = $_POST['permitID'];

    // First, retrieve the file path from the database
    $sql_select_file = "SELECT File_Path FROM permit WHERE FileID = '$permitID'";
    $result = $conn->query($sql_select_file);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = "../" .$row['File_Path'];

        // Delete the file from the server
        if (unlink($file_path)) { // unlink() deletes the file
            // File deleted successfully, now delete from database
            $sql_delete = "DELETE FROM permit WHERE FileID = '$permitID'";
            if ($conn->query($sql_delete) === TRUE) {
                echo 'success';
            } else {
                echo 'error deleting from database';
            }
        } else {
            echo 'error deleting file';
        }
    } else {
        echo 'file not found in database';
    }
} else {
    echo 'invalid permitID';
}
?>
