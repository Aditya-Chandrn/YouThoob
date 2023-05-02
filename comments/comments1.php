<?php
session_start(); // Start the session
include('../db.php'); // Include your database connection file

// var_dump($_SESSION); // Debug: check session variables
// var_dump($_POST); // Debug: check form data

if(isset($_POST['comment1'])){
    if(isset($_SESSION['email']) && isset($_POST['vid'])) {
        $email = $_SESSION['email'];
        $vid = $_POST['vid'];
        $sql = "SELECT video_id FROM video WHERE video_id='$vid'";
        $sql1="SELECT  username,email,name FROM createaccount WHERE email='".$_SESSION['email']."'";
        $result = $conn->query($sql);
        $result1 = $conn->query($sql1);
        if($result->num_rows == 0) {
            // Video ID is invalid, display an error message and stop script execution
            echo "Invalid video ID";
            exit();
        }
        if($result1->num_rows == 0) {
            // Email is invalid, display an error message and stop script execution
            echo "Invalid email ID";
            exit();
        }
        $row1 = $result1->fetch_assoc();
        // Use prepared statements to insert the comment
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $usname = $row1['username'];
        $img1 = $row1['name'];
        $date = date('Y-m-d H:i:s');
        $filename = null;
        $filetype = null;
        $filesize = null;
        if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
            $allowed_images = array("jpg" => "image/jpg", "png" => "image/png", "jpeg" => "image/jpeg");
            $allowed_videos = array("mp4" => "video/mp4", "avi" => "video/x-msvideo", "mov" => "video/quicktime", "wmv" => "video/x-ms-wmv", "flv" => "video/x-flv", "webm" => "video/webm", "mkv" => "video/x-matroska");
            $filename = $_FILES["file"]["name"];
            $filetype = $_FILES["file"]["type"];
            $filesize = $_FILES["file"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (array_key_exists($ext, $allowed_images) || array_key_exists($ext, $allowed_videos)) {
                if (in_array($filetype, $allowed_images) || in_array($filetype, $allowed_videos)) 
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"], "../cimgupload/".$filename);
                    echo "Your file was uploaded successfully.";
                }
                else {
                    echo "Error: please select a valid file format.";
                }
            }
        }
        // Insert the comment into the database
        $query = "INSERT INTO comments (text, rating, email, video_id, username, user_image, date, name, type, size) VALUES ('$comment', '$rating', '$email', '$vid', '$usname','$img1', '$date', '$filename', '$filetype', ' $filesize')";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        // Redirect back to the video page
        header("Location: comments.php?id=".$vid);
        exit();
    }
}
