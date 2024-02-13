<?php
    session_start();

    // Check if files are uploaded
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['videos'])) {
        // Specify the directory where videos will be stored
        $uploadDirectory = 'uploads/';

        // Create the upload directory if it doesn't exist
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $uploadedFiles = $_FILES['videos'];
        $uploadedFileCount = count($uploadedFiles);

        // Loop through each uploaded file
        for ($i = 0; $i < $uploadedFileCount; $i++) {
            $tempFile = $uploadedFiles['tmp_name'][$i];
            $targetFile = $uploadDirectory . basename($uploadedFiles['name'][$i]);

            // Move the file from temporary location to the target location
            if (move_uploaded_file($tempFile, $targetFile)) {
                // File uploaded successfully
            } else {
                // Error uploading file
                http_response_code(500);
                exit();
            }
        }

        // All files uploaded successfully
        http_response_code(200);
    } else {
        // No files uploaded or invalid request
        http_response_code(400);
    }
?>
