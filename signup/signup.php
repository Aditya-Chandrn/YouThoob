<?php
include("db.php");

if(isset($_POST['Sign-in'])){
    $uname=$_POST['uname'];
    $pass =$_POST['pass'];
    if(empty($uname) || empty($pass)) {
        echo "Please enter both User ID and Password";
    }
    else {
        $sql = "SELECT * FROM createaccount WHERE userid='$uname' AND password='$pass'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "User ID and Password already exist in the database";
        }
        else {
            // proceed with inserting the new record
            $fname=$_POST['fname'];
            $mname=$_POST['mname'];
            $lname=$_POST['lname'];
            $bd   =$_POST['bdname'];
            $cno  =$_POST['cno'];
            $cname=$_POST['cname'];
            $sname=$_POST['sname'];
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
                        if (file_exists("upload/".$filename)) {
                            echo $filename . " already exists.";
                        } else {
                            move_uploaded_file($tempname,$folder);
                            $sql = "INSERT INTO createaccount(firstname, middlename, lastname, birthdate, contactnumber, userid, password, city, state, images_source) VALUES ('$fname', '$mname', '$lname', '$bd', '$cno' ,'$uname', '$pass', '$cname', '$sname', '$filename')";
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
                    echo "New record created successfully";
                    header("Location: login1.html");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
    $conn->close();
}
?>