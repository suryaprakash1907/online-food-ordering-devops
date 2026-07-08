<?php

$servername = "127.0.0.1";
$username = "root";
$password = "root123";
$dbname = "myprojectdb";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection Failed : ".$conn->connect_error);
}

$conn->set_charset("utf8");

?>