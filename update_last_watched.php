<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit();
    }

    // Include database connection
    include_once "db_connection.php";

    // Get user ID from session
    $user_id = $_SESSION['user_id'];

    // Get video ID and current position from the request
    $video_id = $_POST['video_id'];
    $current_position = $_POST['current_position'];

    // Update last watched position in the database
    $stmt = $conn->prepare("INSERT INTO last_watched (user_id, video_id, last_watched_position) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE last_watched_position = ?");
    $stmt->bind_param("iiii", $user_id, $video_id, $current_position, $current_position);
    $stmt->execute();
    $stmt->close();
?>
