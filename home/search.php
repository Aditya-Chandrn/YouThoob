<?php
include('../db.php');
if(isset($_POST['search'])){
    $query = $_POST['search'];
    $sql = "SELECT * FROM video WHERE title LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows( $result)>0){
        echo "Yes";
    }
    else{
        echo "NO";
    }
}

?>