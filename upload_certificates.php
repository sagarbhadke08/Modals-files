<?php
session_start();

$userId = $_POST['user_id'];
$_SESSION['user_id'] = $userId;
$attachmentfile = $_FILES['attachment']['name'];
$tmp_names = $_FILES['attachment']['tmp_name'];
$file_count = count($attachmentfile);

$conn = new mysqli('localhost', 'root', '', 'attachments');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$sql = "INSERT INTO attachmentid1 (userId) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$fileId = $stmt->insert_id;
$stmt->close();

$sql = "INSERT INTO attachment_path1 (fileId, fileName) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $fileId, $fileName);

for ($i = 0; $i < $file_count; $i++) { 
    $fileName = $attachmentfile[$i];
    $tmp_name = $tmp_names[$i];
    $folder = "./files/" . $fileName;

    if (move_uploaded_file($tmp_name, $folder)) {
        $stmt->execute();
    } else {
        echo "Error uploading file: " . $_FILES['attachment']['error'][$i];
    }
}

$stmt->close();
$conn->close();
?>