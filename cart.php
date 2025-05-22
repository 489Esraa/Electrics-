<?php
include 'includes/header.php';
redirectIfNotLoggedIn();

// Remove item
if (isset($_GET['remove'])) {
    $pdo->prepare('DELETE FROM cart WHERE user_id=? AND product_id=?')
        ->execute([$_SESSION['user_id'], $_GET['remove']]);
    header('Location: cart.php');
    exit;
}

// Update quantities
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $pid => $qty) {
        $qty = max(1, min(100, (int)$qty));
        $pdo->prepare('UPDATE cart SET quantity=? WHERE user_id=? AND product_id=?')
            ->execute([$qty, $_SESSION['user_id'], $pid]);
    }
    header('Location: cart.php');
    exit;
}

// Get cart items
$stmt = $pdo->prepare(
    'SELECT c.product_id, p.name, p.price, c.quantity, p.image, p.category_id
     FROM cart c
     JOIN products p ON c.product_id = p.product_id
     WHERE c.user_id = ?'
);
$stmt->execute([$_SESSION['user_id']]);
$cart_items = $stmt->fetchAll();

$total = 0;
foreach ($cart_items as $ci) {
    $total += $ci['price'] * $ci['quantity'];
}
?>

<link rel="stylesheet" href="css/cart.css">

<style>
.cart-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
    font-size: 24px; /* Ensure the header size is consistent */
}

.empty-cart {
    text-align: center;
    padding: 20px;
}

.cart-form {
    margin-top: 20px;
}

.cart-header {
    display: grid;
    grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
    background-color: #eaeaea;
    padding: 10px;
    border-radius: 5px;
}

.cart-item {
    display: grid;
    grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    margin-right: 10px;
}

.item-product h3 {
    font-size: 16px;
    margin: 0;
}

.quantity-input {
    width: 60px;
    text-align: center;
}

.item-actions a {
    color: #e74c3c;
    text-decoration: none;
}

.item-actions a:hover {
    text-decoration: underline;
}

.cart-summary {
    margin-top: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
}

.grand-total {
    font-weight: bold;
    font-size: 1.2em;
}

.cart-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-update, .btn-continue, .btn-checkout {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-update {
    background-color: #3498db;
    color: white;
}

.btn-continue {
    background-color: #2ecc71;
    color: white;
}

.btn-checkout {
    background-color: #e67e22;
    color: white;
}

.btn-update:hover {
    background-color: #2980b9;
}

.btn-continue:hover {
    background-color: #27ae60;
}

.btn-checkout:hover {
    background-color: #d35400;
}
</style>



<script>
function updateTotal() {
    const cartItems = document.querySelectorAll('.cart-item');
    let grandTotal = 0;

    cartItems.forEach(item => {
        const priceText = item.querySelector('.item-price').innerText.replace('$', '').replace(/,/g, '');
        const price = parseFloat(priceText);
        const quantity = parseInt(item.querySelector('.quantity-input').value);
        const itemTotal = price * quantity;

        item.querySelector('.item-total').innerText = '$' + itemTotal.toFixed(2);
        grandTotal += itemTotal;
    });

    document.querySelectorAll('.grand-total span:last-child').forEach(span => {
        span.innerText = '$' + grandTotal.toFixed(2);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotal);
    });

    updateTotal();
});
</script>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>
    
    <?php if (empty($cart_items)): ?>
        <div class="empty-cart">
            <p>Your cart is empty</p>
            <br>
            <a href="index.php" class="btn-continue">Continue Shopping</a>
        </div>
    <?php else: ?>
        <form method="post" class="cart-form">
            <div class="cart-items">
                <div class="cart-header">
                    <div class="header-product">Product</div>
                    <div class="header-quantity">Quantity</div>
                    <div class="header-price">Price</div>
                    <div class="header-total">Total</div>
                    <div class="header-actions">Actions</div>
                </div>

                <?php foreach ($cart_items as $ci): ?>
                    <?php $itemTotal = $ci['price'] * $ci['quantity']; ?>
                    <div class="cart-item">
                        <div class="item-product">
                            <img src="Image/<?= 
                                ($ci['category_id'] == 1 ? 'laptops' : 
                                ($ci['category_id'] == 2 ? 'phones' : 
                                ($ci['category_id'] == 3 ? 'Ipads' : 
                                ($ci['category_id'] == 4 ? 'watchs' : 
                                ($ci['category_id'] == 5 ? 'Accessries' : 'default_category')))))
                                ?>/<?= sanitize($ci['image']) ?>" 
                                alt="<?= sanitize($ci['name']) ?>" class="product-image">
                            <h3><?= sanitize($ci['name']) ?></h3>
                        </div>
                        <div class="item-quantity">
                            <input type="number"
                                   name="quantities[<?= $ci['product_id'] ?>]"
                                   value="<?= $ci['quantity'] ?>"
                                   min="1" max="100" class="quantity-input">
                        </div>
                        <div class="item-price"><?= number_format($ci['price'], 2) ?></div>
                        <div class="item-total">$<?= number_format($itemTotal, 2) ?></div>
                        <div class="item-actions">
                            <a href="cart.php?remove=<?= $ci['product_id'] ?>" class="remove-btn">
                                <i class="fas fa-trash-alt"></i> Remove
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping:</span>
                    <span>FREE</span>
                </div>
                <div class="summary-row grand-total">
                    <span>Total:</span>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>
                
                <div class="cart-buttons">
                    <button type="submit" class="btn-update">Update Cart</button>
                    <a href="index.php" class="btn-continue">Continue Shopping</a>
                    <a href="checkout.php" class="btn-checkout">Proceed to Checkout</a>
                </div>
            </div>
        </form>

        <!-- Duplicate total at the top if needed -->
        <div class="cart-summary" style="margin-top: 20px;">
            <div class="summary-row grand-total">
                <span>Total:</span>
                <span>$<?= number_format($total, 2) ?></span>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>