<?php
require 'includes/header.php';
redirectIfNotLoggedIn();

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare('
    SELECT w.product_id, p.name, p.price, p.image, p.category_id
    FROM wishlist w
    JOIN products p ON w.product_id = p.product_id
    WHERE w.user_id = ?
');
$stmt->execute([$user_id]);
$wishlist_items = $stmt->fetchAll();
?>

<link rel="stylesheet" href="css/cart.css"> <!-- Optional styling -->

<div class="cart-container">
    <h2>Your Wishlist</h2>

    <?php if (empty($wishlist_items)): ?>
        <div class="empty-cart">
            <p>Your wishlist is empty</p>
            <a href="index.php" class="btn-continue">Browse Products</a>
        </div>
    <?php else: ?>
        <div class="cart-items">
            <div class="cart-header">
                <div class="header-product">Product</div>
                <div class="header-price">Price</div>
                <div class="header-actions">Actions</div>
            </div>

            <?php foreach ($wishlist_items as $item): ?>
                <div class="cart-item">
                    <div class="item-product">
                        <img src="Image/<?= 
                            ($item['category_id'] == 1 ? 'laptops' :
                            ($item['category_id'] == 2 ? 'phones' :
                            ($item['category_id'] == 3 ? 'Ipads' :
                            ($item['category_id'] == 4 ? 'watchs' :
                            ($item['category_id'] == 5 ? 'Accessries' : 'default')))))
                        ?>/<?= sanitize($item['image']) ?>" 
                        alt="<?= sanitize($item['name']) ?>" class="product-image">
                        <h3><?= sanitize($item['name']) ?></h3>
                    </div>

                    <div class="item-price">$<?= number_format($item['price'], 2) ?></div>

                    <div class="item-actions">
                        <a href="add_to_cart.php?product_id=<?= $item['product_id'] ?>" class="btn-continue">Add to Cart</a>
                        <!-- Toggle wishlist (acts as Remove if already in wishlist) -->
                        <a href="wishlist.php?product_id=<?= $item['product_id'] ?>" class="remove-btn">Remove</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
