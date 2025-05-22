<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
include '../includes/header.php';
$products = $pdo->query('SELECT * FROM products')->fetchAll();
?>
<h2>Products</h2>
<a href="add_product.php">Add New Product</a>
<table>
    <tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>
    <?php foreach($products as $p): ?>
    <tr>
        <td><?= $p['product_id'] ?></td>
        <td><?= sanitize($p['name']) ?></td>
        <td>$<?= $p['price'] ?></td>
        <td>
            <a href="edit_product.php?id=<?= $p['product_id'] ?>">Edit</a>
            <a href="delete_product.php?id=<?= $p['product_id'] ?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>
