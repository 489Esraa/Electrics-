<?php include 'includes/header.php';
if(empty($_GET['id'])){ header('Location: products.php'); exit; }
$stmt = $pdo->prepare('SELECT * FROM products WHERE product_id=?');
$stmt->execute([$_GET['id']]);
$product = $stmt->fetch();
if(!$product){
  echo '<p>Product not found.</p>';
  include 'includes/footer.php';
  exit;
}
?>
<h2><?= sanitize($product['name']) ?></h2>
<p><?= sanitize($product['description']) ?></p>
<p>$<?= $product['price'] ?></p>
<?php if(isLoggedIn()): ?>
    <form method="post" action="wishlist.php">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <button class="btn-primary">Add to Wishlist</button>
    </form>
<?php else: ?>
    <p><a href="login.php">Login</a> to add to wishlist.</p>
    <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>" class="btn-cart">Add to Cart</a>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>
