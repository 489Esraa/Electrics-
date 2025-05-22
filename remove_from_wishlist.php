<?php
require 'includes/config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('DELETE FROM wishlist WHERE user_id = ? AND product_id = ?');
    $stmt->execute([$user_id, $product_id]);
}

header('Location: wishlist.php');
exit;
?>
