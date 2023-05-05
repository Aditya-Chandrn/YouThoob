<?php
session_start(); // Start the session
include('../db.php');
if(isset($_POST['Sign-up'])){
    $email=$_POST['email'];
    $password =$_POST['password'];
    $username=$_POST['username'];
   
    if(empty($username)){
        echo "Please enter all the creditals ";
    }
    if(empty($email) || empty($password)) {
        echo "Please enter both User ID and Password";
    }
    else {
        $sql = "SELECT * FROM createaccount WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Set session variables
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            echo "User ID already exist";
        }
        else {
            // proceed with inserting the new record
            // $username=$_POST['username'];
            $allowed_images = array("jpg" => "image/jpg", "png" => "image/png", "jpeg" => "image/jpeg");
            $filename = $_FILES["file"]["name"];
            if(empty($filename)) {
                echo "Please select an image file";
            }
            else {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $filetype = $_FILES["file"]["type"];
                $filesize = $_FILES["file"]["size"];
                $tempname = $_FILES["file"]["tmp_name"];
                $folder= "../imgupload/".$filename;
                if (array_key_exists($ext, $allowed_images)) {
                    if (in_array($filetype, $allowed_images)) {
                        // Upload image and insert file information into database
                        if (file_exists("../imgupload/".$filename)) {
                            echo $filename . " already exists.";
                        } else {
                            move_uploaded_file($tempname,$folder);
                            $sql = "INSERT INTO createaccount(email,username, password, name,type,size) VALUES ('$email' ,'$username', '$password', '$filename','$filetype','$filesize')";
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
                    $_SESSION['email'] = $email;
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