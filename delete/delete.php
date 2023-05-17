<?php
include('../db.php');
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    if (isset($_GET['video_id'])) {
        $videoId = $_GET['video_id'];
        
        // Update the video_watched table to mark the video as not watched
        $updateQuery = "UPDATE video SET watched = 0 WHERE email='$email' AND video_id='$videoId'";
        if (mysqli_query($conn, $updateQuery)) {
            $_SESSION['success_message'] = "Video removed from history.";
        } else {
            $_SESSION['error_message'] = "Error removing video from history: " . mysqli_error($conn);
        }
        
        // Redirect back to the history page
        header("Location: ../history/history.php");
        exit();
    }
}
?>
