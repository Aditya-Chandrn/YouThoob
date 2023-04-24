<?php
session_start(); // Start the session
include('../db.php');
if(isset($_POST['Sign-up'])){
    $uname=$_POST['uname'];
    $pass =$_POST['pass'];
    $usname=$_POST['usname'];
   
    if(empty($usname)){
        echo "Please enter all the creditals ";
    }
    if(empty($uname) || empty($pass)) {
        echo "Please enter both User ID and Password";
    }
    else {
        $sql = "SELECT * FROM createaccount WHERE userid='$uname'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Set session variables
            $_SESSION['userid'] = $uname;
            $_SESSION['loggedin'] = true;
            echo "User ID already exist";
        }
        else {
            // proceed with inserting the new record
            // $usname=$_POST['usname'];
            $allowed_images = array("jpg" => "image/jpg", "png" => "image/png", "jpeg" => "image/jpeg");
            $filename = $_FILES["file"]["name"];
            if(empty($filename)) {
                echo "Please select an image file";
            }
            else {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $filetype = $_FILES["file"]["type"];
                $tempname = $_FILES["file"]["tmp_name"];
                $folder= "imgupload/".$filename;
                if (array_key_exists($ext, $allowed_images)) {
                    if (in_array($filetype, $allowed_images)) {
                        // Upload image and insert file information into database
                        if (file_exists("imgupload/".$filename)) {
                            echo $filename . " already exists.";
                        } else {
                            move_uploaded_file($tempname,$folder);
                            $sql = "INSERT INTO createaccount(username,userid, password, images_source) VALUES ('$usname' ,'$uname', '$pass', '$filename')";
                            echo "Your image file was uploaded successfully.";
                        }
                    } 
                    else {
                        echo "Error: please select a valid image file format.";
                    }
                }
                else {
                    echo "Error: please select a valid image file format.";
                }
                if ($conn->query($sql) === TRUE) {
                    // Set session variables
                    $_SESSION['userid'] = $uname;
                    $_SESSION['loggedin'] = true;
                    echo "New record created successfully";
                    header("Location: ../login/login.html");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
    $conn->close();
}
?>