<?php 
include("db.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // check if file is uploaded
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {

        // check if title is entered
        if(isset($_POST['title']) && !empty($_POST['title'])) {

            // Check file type and allowed file types
            // $allowed_images = array("jpg" => "image/jpg", "png" => "image/png", "jpeg" => "image/jpeg");
            $allowed_videos = array("mp4" => "video/mp4", "avi" => "video/x-msvideo", "mov" => "video/quicktime", "wmv" => "video/x-ms-wmv", "flv" => "video/x-flv", "webm" => "video/webm", "mkv" => "video/x-matroska");
            $filename = $_FILES["file"]["name"];
            $filetype = $_FILES["file"]["type"];
            $filesize = $_FILES["file"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $title =  $_POST['title'];
            // Check if file is an image
            // if (array_key_exists($ext, $allowed_images)) {
            //     if (in_array($filetype, $allowed_images)) {
            //         // Upload image and insert file information into database
            //         if (file_exists("upload/".$filename)) {
            //             echo $filename . " already exists.";
            //         } else {
            //             move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$filename);
            //             $sql = "INSERT INTO video(name, type, size, title) VALUES ('$filename', '$filetype', '$filesize', '$title')";
            //             if ($conn->query($sql) === TRUE) {
            //                 echo "Image file information was inserted into database successfully.";
            //             } else {
            //                 echo "Error: " . $sql . "<br>" . $conn->error;
            //             }
            //             echo "Your image file was uploaded successfully.";

            //         }
            //     } 
            //     else {
            //         echo "Error: please select a valid image file format.";
            //     }
            // }
            // Check if file is a video
            if (array_key_exists($ext, $allowed_videos)) {
                if (in_array($filetype, $allowed_videos)) {
                    // Upload video and insert file information into database
                    if (file_exists("upload/".$filename)) {
                        echo $filename . " already exists.";
                    } else {
                        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$filename);
                        $sql = "INSERT INTO video (name, type, size, title) VALUES ('$filename', '$filetype', '$filesize', '$title')";
                        if ($conn->query($sql) === TRUE) {
                            echo "Video file information was inserted into database successfully."."<br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        echo "Your video file was uploaded successfully."."<br>";
                        header("Location: home1.php");
                    }
                } else {
                    echo "Error: please select a valid video file format."."<br>";
                }
            }
            // File is not an image or video
            else {
                echo "Error: please select a valid file format.";
            }  
        } 
        else {
            echo "Please enter a valid title.";
        }
    } 
    else {
        echo "Please upload a file.";
    } 
}
?>