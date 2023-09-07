<?php
$conn = new mysqli('localhost', 'root', '', 'attachments');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Check if the image ID is provided
if (isset($_POST['imageId'])) {
    $imageId = $_POST['imageId'];

    // Query to retrieve the image information from the database
    $sql = "SELECT * FROM attachment_path1 WHERE id = '$imageId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fileName = $row['fileName'];
        $filePath = "./files/" . $fileName;

        // Delete the image file from the server
        if (unlink($filePath)) {
            // Delete the image record from the database
            $deleteSql = "DELETE FROM attachment_path1 WHERE id = '$imageId'";
            if ($conn->query($deleteSql) === TRUE) {
                echo "Image deleted successfully.";
            } else {
                echo "Error deleting image: " . $conn->error;
            }
        } 
    } 
    
} else {
    echo "Image ID not provided.";
}

$conn->close();
?>