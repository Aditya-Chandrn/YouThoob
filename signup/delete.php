<?php 
include ("../db.php");
if(isset($_POST['delete'])) {
    $user = $_POST['username'];
    if(empty($user)) {
        echo "Please enter User ID";
    } else {
        $q = "SELECT * FROM createaccount WHERE email='$user'";
        $result = $conn->query($q);
        if($result->num_rows == 0) {
            echo "USER ID DOES NOT EXIST";
        } else {
            $row = mysqli_fetch_assoc($result);
            $profilePicture = $row['name'];

            // Delete profile picture file from the server
            $profilePicturePath = "../imgupload/" . $profilePicture;
            if (file_exists($profilePicturePath)) {
                unlink($profilePicturePath);
            }

            $q1 = "DELETE FROM createaccount WHERE email='$user'";
            $result1 = mysqli_query($conn, $q1);
            if($result1 == True) {
                header("Location:../login/login.html");
            } else {
                header("Location: signup.html");
                echo "There was an error while deleting an account";
            }
        }
    }
}
?>