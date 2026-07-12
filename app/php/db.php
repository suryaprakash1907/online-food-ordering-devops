<?php

$servername = "172.17.0.3";
$username = "root";
$password = "root";
$dbname = "myprojectdb";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}

$conn->set_charset("utf8");

?>
