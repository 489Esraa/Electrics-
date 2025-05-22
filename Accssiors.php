<?php include 'includes/header.php'; ?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Accessories Comparison</title>
  <link rel="stylesheet" href="css/c.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .products-main {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
    }

    .products-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .products-header h1 {
        color: #333;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-card {
        background-color: #fff;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        transition: transform 0.2s;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .product-card img {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    .product-card h3 {
        font-size: 16px;
        margin: 10px 0;
        color: #333;
    }

    .product-card p {
        font-size: 14px;
        color: #666;
    }

    .product-card a {
        display: inline-block;
        margin-top: 8px;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        transition: background-color 0.3s;
    }

    .btn-wishlist {
        background-color: #e74c3c;
    }

    .btn-wishlist:hover {
        background-color: #c0392b;
    }

    .btn-add-to-cart {
        background-color: #3498db;
    }

    .btn-add-to-cart:hover {
        background-color: #2980b9;
    }
  </style>
</head>
<body>

  <main class="products-main">
    <div class="products-header">
      <h1>Accessories</h1>
    </div>

    <div class="product-grid">
      <?php
        $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = 5');
        $stmt->execute();

        while ($p = $stmt->fetch()):
      ?>
      <div class="product-card">
        <img src="Image/Accessries/<?= sanitize($p['image']) ?>" alt="<?= sanitize($p['name']) ?>" />
        <h3><?= sanitize($p['name']) ?></h3>
        <p><?= sanitize($p['description']) ?></p>
        <p>$<?= number_format($p['price'], 2) ?></p>
        <a href="product.php?id=<?= $p['product_id'] ?>">View</a>
        <a href="view_product.php?product_id=<?= $p['product_id'] ?>" class="btn-wishlist">View Product</a>
        <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>&quantity=1" class="btn-add-to-cart">Add to Cart</a>
      </div>
      <?php endwhile; ?>
    </div>
  
  </main>

</body>
</html>

<?php include 'includes/footer.php'; ?>
