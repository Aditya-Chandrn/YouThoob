<?php 
$conn = mysqli_connect("localhost", "root", "", "youthoob");

if(mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
} 
else {
    // echo "Connection successful!";
}
?>
