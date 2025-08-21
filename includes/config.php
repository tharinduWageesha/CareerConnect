<?php
$host = "localhost";
$username="root";
$pass = "";
$dbname = "careerconnect_db";

$conn = mysqli_connect($host,$username,$pass,$dbname);

if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}

session_start();

?>