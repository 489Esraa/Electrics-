<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
include '../includes/header.php';
$orders = $pdo->query(
  'SELECT o.*, u.name
     FROM orders o
     JOIN users u ON o.user_id=u.user_id'
)->fetchAll();
?>
<h2>Orders</h2>
<table>
    <tr><th>ID</th><th>User</th><th>Total</th><th>Status</th></tr>
    <?php foreach($orders as $o): ?>
    <tr>
        <td><?= $o['order_id'] ?></td>
        <td><?= sanitize($o['name']) ?></td>
        <td>$<?= $o['total_amount'] ?></td>
        <td><?= sanitize($o['status']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>
