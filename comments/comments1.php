<?php
session_start(); // Start the session
include('../db.php'); // Include your database connection file

var_dump($_SESSION); // Debug: check session variables
var_dump($_POST); // Debug: check form data

if(isset($_POST['comment'])) {
    if(isset($_SESSION['email']) && isset($_POST['video'])) {
        $email = $_SESSION['email'];
        $vid = $_POST['video'];
        
        // Check if the video ID is valid
        $sql = "SELECT video_id FROM video WHERE video_id='$vid'";
        $sql1="SELECT  username,email,image FROM createaccount WHERE email='".$_SESSION['email']."'";
        $result = $conn->query($sql);
        $result1 = $conn->query($sql1);
        if($result->num_rows == 0) {
            // Video ID is invalid, display an error message and stop script execution
            echo "Invalid video ID";
            exit();
        }
        if($result1->num_rows == 0) {
            // Video ID is invalid, display an error message and stop script execution
            echo "Invalid email ID";
            exit();
        }
        $row1 = $result1->fetch_assoc();
        // Use prepared statements to insert the comment
        $comment = $_POST['comment'];
        $username = $row1['username'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO comments (text, email, video, username,date) VALUES ('$comment', '$email', '$vid', '$username','$date')";
        $stmt = mysqli_prepare($conn, $query);

        
        if(mysqli_stmt_execute($stmt)) {
            // Comment inserted successfully
            header("Location: ../comments/comments.php?video_id=$vid");
            exit(); // Stop script execution
        } 
        else {
            // Error inserting comment
            echo "Error inserting comment: " . mysqli_error($conn);
        }
    }
    else {
        echo "Error inserting comment: session variables not set";
    }
}
else {
    echo "Error inserting comment: comment not set";
}
?>