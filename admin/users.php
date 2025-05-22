<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
include '../includes/header.php';
$users = $pdo->query(
  'SELECT user_id,name,email,role,created_at
     FROM users'
)->fetchAll();
?>
<h2>Users</h2>
<table>
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr>
    <?php foreach($users as $u): ?>
    <tr>
        <td><?= $u['user_id'] ?></td>
        <td><?= sanitize($u['name']) ?></td>
        <td><?= sanitize($u['email']) ?></td>
        <td><?= sanitize($u['role']) ?></td>
        <td><?= $u['created_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>
