<?php
require_once("../../config/connect.php");

if (isset($_POST['OwnerID'])) {
    $ownerID = $_POST['OwnerID'];

    // Fetch all records associated with the OwnerID
    $query = "SELECT FileID, File_Name, File_Path FROM permit WHERE OwnerID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ownerID);
    $stmt->execute();
    $result = $stmt->get_result();

    $files = [];
    while ($row = $result->fetch_assoc()) {
        $files[] = [
            'FileID' => $row['FileID'],
            'File_Name' => $row['File_Name'],
            'File_Path' => '../' . $row['File_Path']
        ];
    }

    if (!empty($files)) {
        echo json_encode(['files' => $files]);
    } else {
        echo json_encode(['OwnerID' => $ownerID]);
    }
} else {
    echo json_encode(['error' => 'OwnerID not provided']);
}
?>
