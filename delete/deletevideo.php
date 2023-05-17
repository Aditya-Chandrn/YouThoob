<?php
include("../db.php");
session_start();
if (isset($_SESSION['email'])) {
    if (isset($_POST['delete'])) {
        $email = $_SESSION['email'];
        $id = $_GET['id'];
        $q = "SELECT * FROM createaccount WHERE email='$email'";
        $result = $conn->query($q);

        if ($result->num_rows == 0) {
            echo "User ID does not exist";
        } else {
            $q1 = "SELECT * FROM video WHERE email='$email' and video_id='$id'";
            $result1 = mysqli_query($conn, $q1);
            $row = mysqli_fetch_assoc($result1);
            $videoFileName = $row['name'];
            
            // Delete video file from the uploaded videos folder
            $videoFilePath = "../uploaded_vid/" . $videoFileName;
            if (file_exists($videoFilePath)) {
                unlink($videoFilePath);
            }

            // Delete video entry from the database
            $q2 = "DELETE FROM video WHERE email='$email' and video_id='$id'";
            $result2 = mysqli_query($conn, $q2);

            if ($result2) {
                header("Location:../home/home.php");
            } else {
                header("Location: ../myvideos/myvideos.php");
                echo "There was an error while deleting the video";
            }
        }
    }
}
?>