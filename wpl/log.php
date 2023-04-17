<?php
$user=$_POST["user"];
$pass=$_POST["pass"];
$Cno=$_POST["Pnumber"];
$dbhost="localhost";
$dbName="o";
$user="root";
$pass="";
$conn=new
mysqli($dbhost,$user,$pass, $dbName);
try{
    echo "Successfully connected with nwedb database";
}
catch(Exception $e){
    die("Connection failed".$e>getMessage());
}
?>