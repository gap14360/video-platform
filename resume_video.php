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

    // Retrieve last watched position from the database for the user
    $stmt = $conn->prepare("SELECT video_id, last_watched_position FROM last_watched WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($video_id, $last_watched_position);
    $stmt->fetch();
    $stmt->close();

    // Redirect to the video player page with the video ID and last watched position
    header("Location: video_player.php?video_id=$video_id&position=$last_watched_position");
    exit();
?>
