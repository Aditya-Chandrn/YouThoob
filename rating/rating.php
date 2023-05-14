<?php
session_start(); // Start the session
include('../db.php');
if(isset($_POST['rating1']) && isset($_SESSION['email']) && isset($_POST['vid'])) { 
        $vid = $_POST['vid'];
        $sql = "SELECT * FROM rating  WHERE email='{$_SESSION['email']}' and video_id='$vid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "You Cant  rate the video again";
        } 
        else 
        {
            $rating = $_POST['rating'];
            $sql = "SELECT video_id FROM video WHERE video_id='$vid'";
            $sql1 = "SELECT username, email, name FROM createaccount WHERE email='{$_SESSION['email']}'";
            $result = $conn->query($sql);
            $result1 = $conn->query($sql1);
            if ($result->num_rows == 0) {
                // Video ID is invalid, display an error message and stop script execution
                echo "Invalid video ID";
                exit();
            }
            if ($result1->num_rows == 0) {
                // Email is invalid, display an error message and stop script execution
                echo "Invalid email ID";
                exit();
            }
            $row1 = $result1->fetch_assoc();
            $email = $row1['email'];
            $usname = $row1['username'];
            $query = "INSERT INTO rating (rating, video_id, username, email) VALUES ('$rating', '$vid', '$usname', '$email')";
            $stmt = mysqli_prepare($conn, $query);
            if (mysqli_stmt_execute($stmt)) {
                // Rating was inserted successfully, redirect back to the video page
                header("Location: ../comments/comments.php?id=".$vid);
                exit();
            } 
            else {
                // Rating was not inserted, display an error message
                echo "Error inserting rating";
            }
            mysqli_stmt_close($stmt);
        }
    
}
else{
    echo "Please rate the video";
}
?>