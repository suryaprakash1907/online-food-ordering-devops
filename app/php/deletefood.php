<?php

header("Content-Type: application/json");

require "db.php";

$id=$_GET["id"] ?? 0;

if($id==0){

    echo json_encode([
        "success"=>false,
        "message"=>"Invalid Food ID"
    ]);

    exit;

}

$conn->begin_transaction();

try{

$stmt=$conn->prepare("
DELETE FROM order_items
WHERE product_id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

$stmt=$conn->prepare("
DELETE FROM menu_items
WHERE id=?
");

$stmt->bind_param("i",$id);

$stmt->execute();

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