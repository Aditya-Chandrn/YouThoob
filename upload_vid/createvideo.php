<?php 
include('../db.php');
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // Check if user is logged in
    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Check if a file is uploaded
        if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

            // Check if title is entered
            if(isset($_POST['title']) && !empty($_POST['title'])) 
            {

                // Check file type and allowed file types
                $allowed_videos = array(
                    "mp4" => "video/mp4",
                    "avi" => "video/x-msvideo",
                    "mov" => "video/quicktime",
                    "wmv" => "video/x-ms-wmv",
                    "flv" => "video/x-flv",
                    "webm" => "video/webm",
                    "mkv" => "video/x-matroska"
                );

                $filename = $_FILES["file"]["name"];
                $filetype = $_FILES["file"]["type"];
                $filesize = $_FILES["file"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $title = $_POST['title'];
                $desc = $_POST['desc'];
                $date = date('Y-m-d H:i:s');

                $sql = "SELECT user_id, username,email,name FROM createaccount WHERE email='".$_SESSION['email']."'";
                $result = $conn->query($sql);
                // $result = mysqil_query($conn,$sql);

                // Check if user exists in database
                if ($result->num_rows > 0) {
                    // Fetch user information and insert into video table
                    $row = $result->fetch_assoc();
                    $id = $row['email'];
                    $username=$row['username'];
                    $acid = $row['user_id'];
                    $img = $row['name'];

                    // Check if file is a video
                    if (array_key_exists($ext, $allowed_videos)) {
                        if (in_array($filetype, $allowed_videos)) {
                            // Upload video and insert file information into database
                            if (file_exists('../uploaded_vid/'.$filename)) {
                                echo $filename . " already exists.";
                            } else {
                                move_uploaded_file($_FILES["file"]["tmp_name"], '../uploaded_vid/'.$filename);
                                $sql = "INSERT INTO video (name, type, size, title,description, username, email,user_id,date,image_name) 
                                        VALUES ('$filename', '$filetype', '$filesize', '$title','$desc','$username', '$id','$acid','$date','$img')";
                                if ($conn->query($sql) === TRUE) {
                                    $vid = $conn->insert_id;
                                    echo "Video file information was inserted into database successfully."."<br>";
                                    $_SESSION['video_id']=$vid;
                                    header("Location: ../home/home.php");
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                        } 
                        else {
                            echo "Error: Invalid file type."."<br>";
                        }
                    } 
                    else {
                        echo "Error: Invalid file extension."."<br>";
                    }
                } 
                else {
                    echo "Error: User does not exist in database."."<br>";
                }
            } else {
                echo "Error: Please enter a title."."<br>";
            }
        } 
        else {
            echo "Error: Please upload a file."."<br>";
        }
    } 
    else {
        echo "Error: User not logged in."."<br>";
    }
}
?>