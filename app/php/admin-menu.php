<?php

require "db.php";

$result=$conn->query("SELECT * FROM menu_items ORDER BY category,name");

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Menu</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<header class="navbar">

<div class="logo">

🍔 Foodie's Hub Admin

</div>

<nav>

<a href="../index.html">Home</a>

<a href="admin-orders.php">Orders</a>

</nav>

</header>

<section style="padding:40px;">

<h1>Add Food Item</h1>

<form action="addfood.php" method="POST">

<input
type="text"
name="name"
placeholder="Food Name"
required>

<input
type="text"
name="description"
placeholder="Description"
required>

<input
type="number"
step="0.01"
name="price"
placeholder="Price"
required>

<input
type="text"
name="category"
placeholder="Category"
required>

<input
type="text"
name="image_url"
placeholder="Image URL">

<button type="submit">

Add Food

</button>

</form>

<hr>

<h2>Food Menu</h2>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Category</th>

<th>Price</th>

<th>Action</th>

</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?= $row["id"] ?></td>

<td><?= $row["name"] ?></td>

<td><?= $row["category"] ?></td>

<td>₹<?= $row["price"] ?></td>

<td>

<a href="deletefood.php?id=<?= $row["id"] ?>">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</section>

</body>

</html>