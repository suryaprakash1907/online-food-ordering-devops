<?php

header("Content-Type: application/json");

require "db.php";

$sql="SELECT * FROM menu_items ORDER BY category,name";

$result=$conn->query($sql);

$menu=[];

while($row=$result->fetch_assoc()){

    $menu[$row["category"]][]=$row;

}

echo json_encode($menu);

$conn->close();

?>