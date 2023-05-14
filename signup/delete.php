<?php 
include ("../db.php");
if(isset($_POST['delete']))
{
    $user= $_POST['username'];
    if(empty($user))
    {
    echo  "Please enter User ID ";
    }
    else
    {
    $q= "SELECT * FROM createaccount where email='$user'";
    $result= $conn->query($q);
    if($result->num_rows == 0){
        echo "USER ID DOES NOT EXIST";
    }
    else
    {
        $q1 ="DELETE fROM createaccount where email='$user'";
        // $result1= $conn->query($q1);
        $result1= mysqli_query($conn,$q1);
        if($result1 == True)
        {
        header("Location:../login/login.html");
        }
        else
        {
            header("Location: signup.html");
            echo "There was an error while deleting an account";
        }

    }
    }
}
?>
