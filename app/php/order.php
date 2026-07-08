<?php

header("Content-Type: application/json");

require "db.php";

$data=json_decode(file_get_contents("php://input"),true);

if(!$data){

    echo json_encode([
        "success"=>false,
        "message"=>"Invalid Data"
    ]);

    exit;

}

$customerName=$data["customerName"];

$phone=$data["phone"];

$address=$data["address"];

$paymentMethod=$data["paymentMethod"];

$items=$data["items"];

$totalPrice=0;

foreach($items as $item){

    $totalPrice+=$item["price"]*$item["quantity"];

}

$conn->begin_transaction();

try{

$stmt=$conn->prepare("

INSERT INTO orders

(customer_name,phone,address,payment_method,total_price)

VALUES

(?,?,?,?,?)

");

$stmt->bind_param(

"ssssd",

$customerName,

$phone,

$address,

$paymentMethod,

$totalPrice

);

$stmt->execute();

$orderId=$conn->insert_id;

$stmt=$conn->prepare("

INSERT INTO order_items

(order_id,product_id,quantity)

VALUES

(?,?,?)

");

foreach($items as $item){

$stmt->bind_param(

"iii",

$orderId,

$item["id"],

$item["quantity"]

);

$stmt->execute();

}

$conn->commit();

echo json_encode([

"success"=>true

]);

}

catch(Exception $e){

$conn->rollback();

echo json_encode([

"success"=>false,

"message"=>$e->getMessage()

]);

}

$conn->close();

?>