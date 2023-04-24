<?php
session_start(); // Start the session
include('../db.php'); // Include your database connection file

var_dump($_SESSION); // Debug: check session variables
var_dump($_POST); // Debug: check form data

if(isset($_POST['comment'])) {
    if(isset($_SESSION['userid']) && isset($_POST['vid'])) {
        $email = $_SESSION['userid'];
        $vid = $_POST['vid'];
        
        // Check if the video ID is valid
        $sql = "SELECT id FROM video WHERE id='$vid'";
        $sql1="SELECT  username,userid,images_source FROM createaccount WHERE userid='".$_SESSION['userid']."'";
        $result = $conn->query($sql);
        $result1 = $conn->query($sql1);
        if($result->num_rows == 0) {
            // Video ID is invalid, display an error message and stop script execution
            echo "Invalid video ID";
            exit();
        }
        if($result1->num_rows == 0) {
            // Video ID is invalid, display an error message and stop script execution
            echo "Invalid userid ID";
            exit();
        }
        $row1 = $result1->fetch_assoc();
        // Use prepared statements to insert the comment
        $comment = $_POST['comment'];
        $usname = $row1['username'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO comments (text, userid, vid, username,date) VALUES ('$comment', '$email', '$vid', '$usname','$date')";
        $stmt = mysqli_prepare($conn, $query);

        
        if(mysqli_stmt_execute($stmt)) {
            // Comment inserted successfully
            header("Location: comments.php?id=$vid");
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