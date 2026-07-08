<?php

header("Content-Type: application/json");

require "db.php";

if($_SERVER["REQUEST_METHOD"]!="POST"){

    echo json_encode([
        "success"=>false,
        "message"=>"Invalid Request"
    ]);

    exit;

}

$name=$_POST["name"] ?? "";
$description=$_POST["description"] ?? "";
$price=$_POST["price"] ?? 0;
$category=$_POST["category"] ?? "";
$image=$_POST["image_url"] ?? "images/placeholder.jpg";

$stmt=$conn->prepare("
INSERT INTO menu_items
(name,description,price,category,image_url)
VALUES
(?,?,?,?,?)
");

$stmt->bind_param(
"ssdss",
$name,
$description,
$price,
$category,
$image
);

if($stmt->execute()){

    echo json_encode([
        "success"=>true,
        "message"=>"Food Added Successfully"
    ]);

}
else{

    echo json_encode([
        "success"=>false,
        "message"=>"Failed to Add Food"
    ]);

}

$stmt->close();
$conn->close();

?>