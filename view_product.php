<?php
require 'includes/header.php';

// Check if a product ID is provided in the URL
if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
    echo "Invalid product ID.";
    exit;
}

$product_id = $_GET['product_id'];

// Fetch product details from the database
$stmt = $pdo->prepare('
    SELECT p.name, p.description, p.price, p.image, p.category_id, c.name AS category_name
    FROM products p
    JOIN categories c ON p.category_id = c.category_id
    WHERE p.product_id = ?
');
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Product not found.";
    exit;
}
?>
 <link rel="stylesheet" href="css/c.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/style.css">

<style>
/* Page-wide layout styling */
.product-container {
    width: 100%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 40px 20px;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

/* Product name */
.product-container h2 {
    font-size: 3rem;
    color: #222;
    margin-bottom: 30px;
    text-align: center;
}

/* Flex container */
.product-details {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 40px;
    flex-wrap: wrap;
}

/* Product image */
.product-image {
    flex: 1 1 45%;
    text-align: center;
}
.product-image img {
    width: 100%;
    max-width: 600px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

/* Product info */
.product-info {
    flex: 1 1 45%;
    font-size: 1.4rem;
    color: #444;
}

.product-info p {
    margin-bottom: 20px;
    line-height: 1.8;
}

.product-info strong {
    font-size: 1.6rem;
    color: #111;
}

/* Price styling */
.product-info .price {
    font-size: 2rem;
    font-weight: bold;
    color: #27ae60;
}

/* Add to Cart button */
.btn-continue {
    display: inline-block;
    background-color: #27ae60;
    color: #fff;
    padding: 15px 30px;
    font-size: 1.3rem;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

.btn-continue:hover {
    background-color: #2ecc71;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .product-details {
        flex-direction: column;
        align-items: center;
    }

    .product-info {
        text-align: center;
    }

    .product-info strong,
    .product-info .price {
        font-size: 1.8rem;
    }

    .btn-continue {
        width: 100%;
        margin-top: 30px;
    }
}
</style>

<div class="product-container">
    <h2><?= sanitize($product['name']) ?></h2>

    <div class="product-details">
        <div class="product-image">
            <img src="Image/<?=
                ($product['category_id'] == 1 ? 'laptops' :
                ($product['category_id'] == 2 ? 'phones' :
                ($product['category_id'] == 3 ? 'Ipads' :
                ($product['category_id'] == 4 ? 'watchs' :
                ($product['category_id'] == 5 ? 'Accessries' : 'default')))))
            ?>/<?= sanitize($product['image']) ?>"
            alt="<?= sanitize($product['name']) ?>">
        </div>

        <div class="product-info">
            <p><strong>Category:</strong> <?= sanitize($product['category_name']) ?></p>
            <p class="price">$<?= number_format($product['price'], 2) ?></p>
            <p><strong>Description:</strong> <?= sanitize($product['description']) ?></p>
            <a href="add_to_cart.php?product_id=<?= $product_id ?>" class="btn-continue">Add to Cart</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
