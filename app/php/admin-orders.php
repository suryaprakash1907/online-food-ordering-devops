<?php

require "db.php";

$result=$conn->query("

SELECT *

FROM orders

ORDER BY order_date DESC

");

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Orders</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<header class="navbar">

<div class="logo">

📦 Orders

</div>

<nav>

<a href="../index.html">

Home

</a>

<a href="admin-menu.php">

Menu

</a>

</nav>

</header>

<section style="padding:40px;">

<h1>Customer Orders</h1>

<table>

<tr>

<th>ID</th>

<th>Customer</th>

<th>Phone</th>

<th>Total</th>

<th>Status</th>

<th>Date</th>

</tr>

<?php while($row=$result->fetch_assoc()){ ?>

<tr>

<td><?= $row["id"] ?></td>

<td><?= htmlspecialchars($row["customer_name"]) ?></td>

<td><?= htmlspecialchars($row["phone"]) ?></td>

<td>₹<?= number_format($row["total_price"],2) ?></td>

<td><?= htmlspecialchars($row["status"]) ?></td>

<td><?= htmlspecialchars($row["order_date"]) ?></td>

</tr>

<?php } ?>

</table>

</section>

</body>

</html>