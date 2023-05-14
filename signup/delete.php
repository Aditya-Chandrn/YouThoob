<?php 
include ("../db.php");
$user= $_POST['username'];
if(isset($_POST['username']))
{
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
        $result1= $conn->query($q1);
        if($result1 == True)
        {
        header("Location:../login/login.html");
        }
        else
        {
            echo "there was an error while deleting an account";
        }

    }
    }
}
?>
