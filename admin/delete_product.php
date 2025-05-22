<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
if(!empty($_GET['id'])){
    $pdo->prepare('DELETE FROM products WHERE product_id=?')
        ->execute([$_GET['id']]);
}
header('Location: products.php');
