<?php


$conn = new mysqli('localhost', 'root', '', 'attachments');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

    $sql = "SELECT * FROM attachment_path1 WHERE fileId = (SELECT MAX(id) FROM attachmentid1)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through the retrieved attachments
        while ($row = $result->fetch_assoc()) {
            $fileName = $row['fileName'];
            $fileUrl = "./files/" . $fileName;
            $imageId = $row['id'];
            
            $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
           
            if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
                // Display the image within an image container
                echo '<div class="image-container">';
                echo '<div class="image-wrapper">';
                echo '<a href="' . $fileUrl . '" target="_blank"><img src="' . $fileUrl . '" alt="' . $fileName . '" /></a>';
                echo '</div>';
                echo '<h6>' . $fileName . '</h6>'; // Display the image name
                echo '<div class="download-container">';
                echo '<a class="btn btn-primary btn-sm" href="' . $fileUrl . '" download>Download</a>';
                echo '</div>';
                echo '<div class="delete-container">';
                echo "<button class='btn btn-danger btn-sm delete-image' data-image-id='" . $imageId . "'>X</button>";
                echo '</div>';
                echo '</div>';
            } elseif (strtolower($fileExtension) === 'pdf') {
                echo '<div class="pdf-container">';
                echo '<div class="image-container">';
                echo '<div class="image-wrapper">';
                echo '<a href="' . $fileUrl . '" target="_blank"><iframe src="' . $fileUrl . '" type="application/pdf" width="100%" height="400px"></iframe></a>';
                echo '</div>';
                echo '<h6>' . $fileName . '</h6>'; 
                echo '<div class="download-container">';
                echo '<a class="btn btn-primary btn-sm" href="' . $fileUrl . '" download>Download</a>';
                echo '</div>';
                echo '<div class="delete-container">';
                echo "<button class='btn btn-danger btn-sm delete-image' data-image-id='" . $imageId . "'>X</button>";
                echo '</div>';
                echo '</div>';
                echo '</div>';
        
            }
            
        }
    } else {
        echo "No attachments found for the given user ID.";
    }

$conn->close();
?>
