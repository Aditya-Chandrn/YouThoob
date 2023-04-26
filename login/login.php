<?php
include('../db.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // prepare the query
    $stmt = $conn->prepare("SELECT * FROM createaccount WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    
    // get the result
    $result = $stmt->get_result();
  
    // check if the result is not empty
    if($result->num_rows > 0){
        // redirect to home.php
        $_SESSION['email'] = $email;
        header("Location: ../home/home.php");
        exit();
    }
    else{
        // alert("Invalid Email ID AND PASSWORD");
        header("Location: ../login/login.html");
    }
}
?>