<?php
include("db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['Email'];
    $password = $_POST['password'];
    
    // prepare the query
    $stmt = $conn->prepare("SELECT * FROM createaccount WHERE userid = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    
    // get the result
    $result = $stmt->get_result();
    
    // check if the result is not empty
    if($result->num_rows > 0){
        // redirect to home1.php
        header("Location: home1.php");
        exit();
    }
    else{
        // display an error message
        echo "Invalid email or password";
    }
}
?>