<?php

require_once 'query_execute.php';
function uploadImage($db, $username, $imageFile)
{
    // Check if a file is uploaded
    if ($_FILES['profile-image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/';
        $uploadFile = $uploadDir . basename($_FILES['profile-image']['name']);

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $uploadFile)) {
            // File uploaded successfully, update the image path in the database
            $imagePath = $uploadFile;
            $query = "UPDATE users SET image = :image WHERE username = :username";
            $params = [':image' => $imagePath, ':username' => $username];
            
            // Execute the query using executeQuery function
            $success = executeQuery($db, $query, $params);
            
            if ($success) {
                echo "File uploaded and database updated successfully.";
            } else {
                echo "Failed to update database.";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}
?>
