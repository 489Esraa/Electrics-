<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
include '../includes/header.php';
?>
<h2>Admin Dashboard</h2>
<ul>
    <li><a href="products.php">Manage Products</a></li>
    <li><a href="orders.php">Manage Orders</a></li>
    <li><a href="users.php">Manage Users</a></li>
</ul>
<?php include '../includes/footer.php'; ?>
