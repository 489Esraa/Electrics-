<?php include 'includes/header.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/c.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/a.css">
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

    .featured-section {
        margin-bottom: 40px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .featured-section h2 {
        text-align: center;
        color: #333;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .product-card {
        background-color: #f9f9f9;
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
        margin: 5px 0;
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
        background-color: rgb(53, 128, 178);
    }

    /* .product-card a:last-child {
        background-color: #2ecc71;
    } */

    .product-card a:last-child:hover {
        background-color: #27ae60;
    }

    :root {
        --primary-color: #000000;
        --secondary-color: #ff6b6b;
        --accent-color: #4ecdc4;
        --text-color: #2d3436;
        --text-light: #636e72;
        --bg-light: #f9f9f9;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        overflow-x: hidden;
        background-color: white;
        font-family: 'Poppins', sans-serif;
        color: var(--text-color);
        scroll-behavior: smooth;
    }

    /* Header Styles */
    #menuToggle {
        display: none;
    }

    header {
        background-color: var(--primary-color);
        color: white;
        padding: 15px 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
    }

    .right-icons {
        display: flex;
        gap: 20px;
    }

    .right-icons a,
    .right-icons label {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .right-icons a:hover,
    .right-icons label:hover {
        color: var(--accent-color);
        transform: scale(1.1);
    }

    .right-icons i {
        font-size: 1.2rem;
    }

    .logo img {
        width: 50px;
        height: auto;
        transition: all 0.3s ease;
    }

    /* Side Menu - Now on the LEFT side */
    .side-menu {
        position: fixed;
        top: 0;
        left: -300px;
        /* Changed from right */
        width: 300px;
        height: 100%;
        background-color: white;
        color: black;
        padding: 30px;
        box-shadow: 5px 0 25px rgba(0, 0, 0, 0.1);
        /* Shadow on right side now */
        transition: all 0.4s cubic-bezier(0.65, 0.05, 0.36, 1);
        z-index: 2000;
        overflow-y: auto;
    }

    #menuToggle:checked~.side-menu {
        left: 0;
        /* Changed from right */
    }

    .side-menu .close-btn {
        display: block;
        font-size: 1.8rem;
        cursor: pointer;
        margin-bottom: 30px;
        text-align: left;
        /* Changed from right */
        color: var(--secondary-color);
        transition: all 0.3s ease;
    }

    .side-menu .close-btn:hover {
        transform: rotate(90deg);
        background-color: rgb(176, 85, 85);
    }

    .side-menu ul {
        list-style: none;
        font-weight: 600px;
        font-size: 20px;
    }

    .side-menu li {
        margin: 20px 0;
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        font-weight: 600;
        transform: translateY(-10px);

    }

    .side-menu li:hover {
        color: rgb(203, 86, 86);
        padding-left: 10px;
        /* Changed from right */
        transform: translateY(-10px);
        background-color: rgb(185, 130, 130);
    }

    /* Overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1500;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
    }

    #menuToggle:checked~.overlay {
        opacity: 1;
        visibility: visible;
    }

    /* Hero Section - Image on left, text on right */
    .hero-section {
        display: flex;
        align-items: center;
        min-height: 100vh;
        padding: 120px 5% 60px;
        background-color: var(--bg-light);
        position: relative;
        overflow: hidden;
    }

    .hero-image {
        flex: 1;
        position: relative;
        z-index: 2;
        padding-right: 50px;
    }

    .hero-image img {
        width: 100%;
        max-width: 800px;
        height: auto;
        display: block;
        border-radius: 10px;
        box-shadow: 1 25px 50px -12px rgba(16, 7, 7, 0.25);
        transform: translateY(0);
        transition: transform 0.5s ease;
    }

    .hero-image:hover img {
        transform: translateY(-20px);
    }

    .hero-content {
        flex: 1;
        position: relative;
        z-index: 2;
        padding-left: 50px;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-color);

        line-height: 1.2;
    }

    .hero-content h1 span {
        color: var(--secondary-color);
    }

    .hero-content p {
        font-size: 1.2rem;
        line-height: 1.8;
        color: var(--text-light);
        margin-bottom: 30px;
        font-weight: 400;
        max-width: 800px;
    }

    /* Decorative Elements */
    .circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(78, 205, 196, 0.1);
        z-index: 1;
    }

    .circle-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -150px;
    }

    .circle-2 {
        width: 200px;
        height: 200px;
        bottom: -100px;
        left: -100px;
        background: rgba(255, 107, 107, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-section {
            flex-direction: column;
            text-align: center;
        }





        .hero-content h1 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-content p {
            font-size: 1rem;
        }

        .side-menu {
            width: 280px;
        }

        .hero-image img {
            max-width: 100%;
        }
    }

    /* New Products Section */
    .products-section {
        padding: 80px 5%;
        background-color: white;
        position: relative;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-size: 2.5rem;
        color: var(--primary-color);
        position: relative;
        display: inline-block;
    }

    .section-title h2::after {
        content: "";
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--secondary-color);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .product-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: center;
        padding: 30px 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .product-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, rgba(78, 205, 196, 0.1) 0%, rgba(255, 107, 107, 0.1) 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .product-icon img {
        width: 80%;
        height: auto;
        object-fit: contain;
        transition: all 0.3s ease;
    }

    .product-card:hover .product-icon {
        background: linear-gradient(135deg, var(--accent-color) 0%, var(--secondary-color) 100%);
        transform: scale(1.05);
    }

    .product-card:hover .product-icon img {
        transform: scale(1.1);
    }

    .product-card h3 {
        font-size: 1.4rem;
        margin-bottom: 15px;
        color: var(--primary-color);
    }

    .product-card p {
        color: var(--text-light);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .myprofile {
        margin-top: 150px;
        font-weight: 600;
        font-size: 20px;
    }

    .myprofile:hover {
        transform: translateY(-10px);


    }

    a:hover {
        color: #6b2020;


    }

    a {
        text-decoration: none;
        color: #000000;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .product-icon {
            width: 80px;
            height: 80px;
        }
    }
    </style>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="spinning-icons">
        <div class="icon-orbit"><i class="fa-solid fa-laptop"></i></div>
        <div class="icon-orbit"><i class="fa-solid fa-tv"></i></div>
        <div class="icon-orbit"><i class="fa-solid fa-headphones-simple"></i></div>
        <div class="icon-orbit"><i class="fa-solid fa-keyboard"></i></div>
        <div class="icon-orbit"><i class="fa-solid fa-computer-mouse"></i></div>
        <div class="icon-orbit"><i class="fa-solid fa-computer"></i></div>
    </div>
    </div>


    <div class="hero-content">
        <h1>Welcome to <span>Electronix</span></h1>
        <p>
            Your premier destination for cutting-edge electronics. Discover our wide range of smartphones,
            laptops,
            tablets, and smart devices at competitive prices with exceptional warranty. Experience the
            future of
            technology with us and enjoy a seamless shopping experience that puts innovation at your
            fingertips.
        </p>
    </div>
    </section>

    <script>
    const overlay = document.querySelector('.overlay');
    overlay.addEventListener('click', function() {
        document.getElementById('menuToggle').checked = false;
    });


    document.querySelectorAll('.side-menu li').forEach(item => {
        item.addEventListener('click', function() {
            document.getElementById('menuToggle').checked = false;
        });
    });
    </script>
    <section class="products-section">
        <div class="section-title">
            <h2>Our Premium Products</h2>
        </div>

        <div class="products-grid">

            <div class="product-card">
                <div class="product-icon">
                    <a href="Tv.html"><img src="image/mac.jpg" alt="Mac"></a>
                </div>
                <h3>Mac</h3>
                <p>Powerful notebooks and desktops with Apple silicon. Supercharged for pros.</p>
            </div>


            <div class="product-card">
                <div class="product-icon">
                    <a href="ipad.html"><img src="image/ipad.jpg" alt="iPad"></a>
                </div>
                <h3>iPad</h3>
                <p>Versatile tablets with stunning displays and incredible performance.</p>
            </div>


            <div class="product-card">
                <div class="product-icon">
                    <a href="phones.html"><img src="image/iphone.jpg" alt="iPhone"></a>
                </div>
                <h3>iPhone</h3>
                <p>The most advanced iPhone lineup with revolutionary camera systems.</p>
            </div>


            <div class="product-card">
                <div class="product-icon">
                    <a href="smartv wach.html"><img src="image/watch.jpg" alt="Apple Watch"></a>
                </div>
                <h3>Apple Watch</h3>
                <p>The ultimate device for a healthy life. Now with advanced health features.</p>
            </div>


            <div class="product-card">
                <div class="product-icon">
                    <a href="air podes(m).html"><img src="image/airpods.jpg" alt="AirPods"></a>
                </div>
                <h3>AirPods</h3>
                <p>Magical wireless headphones with effortless setup and incredible sound.</p>
            </div>


            <div class="product-card">
                <div class="product-icon">
                    <a href="accessories (m).html"><img src="image/accessries.jpg" alt="Accessories"></a>
                </div>
                <h3>Accessories</h3>
                <p>Cables, adapters, cases and more to complement your Apple devices.</p>
            </div>
        </div>
    </section>

    <br>
    <br>




    <main class="products-main">


        <section class="featured-section">
            <h2>Featured Phones</h2>
            <br>
            <div class="product-grid">
                <?php
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = 2 LIMIT 5');
          $stmt->execute();
          while ($p = $stmt->fetch()): ?>
                <div class="product-card">
                    <img src="Image/phones/<?= sanitize($p['image']) ?>" alt="<?= sanitize($p['name']) ?>" />
                    <h3><?= sanitize($p['name']) ?></h3>
                    <p>$<?= number_format($p['price'], 2) ?></p>
                    <a href="product.php?id=<?= $p['product_id'] ?>">View</a>
                    <a href="view_product.php?product_id=<?= $p['product_id'] ?>" class="btn-wishlist">View
                        Product</a>
                    <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>&quantity=1" class="btn-add-to-cart">Add
                        to Cart</a>
                </div>
                <?php endwhile; ?>
            </div>
        </section>


        <section class="featured-section">
            <h2>Featured Laptops</h2>
            <br>
            <div class="product-grid">
                <?php
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = 1 LIMIT 5');
          $stmt->execute();
          while ($p = $stmt->fetch()): ?>
                <div class="product-card">
                    <img src="Image/laptops/<?= sanitize($p['image']) ?>" alt="<?= sanitize($p['name']) ?>" />
                    <h3><?= sanitize($p['name']) ?></h3>
                    <p>$<?= number_format($p['price'], 2) ?></p>
                    <a href="product.php?id=<?= $p['product_id'] ?>">View</a>
                    <a href="view_product.php?product_id=<?= $p['product_id'] ?>" class="btn-wishlist">View
                        Product</a>
                    <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>&quantity=1" class="btn-add-to-cart">Add
                        to Cart</a>
                </div>
                <?php endwhile; ?>
            </div>
        </section>


        <section class="featured-section">
            <h2>Featured Tablets</h2>
            <br>
            <div class="product-grid">
                <?php
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = 3 LIMIT 5');
          $stmt->execute();
          while ($p = $stmt->fetch()): ?>
                <div class="product-card">
                    <img src="Image/Ipads/<?= sanitize($p['image']) ?>" alt="<?= sanitize($p['name']) ?>" />
                    <h3><?= sanitize($p['name']) ?></h3>
                    <p>$<?= number_format($p['price'], 2) ?></p>
                    <a href="product.php?id=<?= $p['product_id'] ?>">View</a>
                    <a href="view_product.php?product_id=<?= $p['product_id'] ?>" class="btn-wishlist">View
                        Product</a>
                    <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>&quantity=1" class="btn-add-to-cart">Add
                        to Cart</a>
                </div>
                <?php endwhile; ?>
            </div>
        </section>


        <section class="featured-section">
            <h2>Featured Watches</h2>
            <br>
            <div class="product-grid">
                <?php
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = 4 LIMIT 5');
          $stmt->execute();
          while ($p = $stmt->fetch()): ?>
                <div class="product-card">
                    <img src="Image/watchs/<?= sanitize($p['image']) ?>" alt="<?= sanitize($p['name']) ?>" />
                    <h3><?= sanitize($p['name']) ?></h3>
                    <p>$<?= number_format($p['price'], 2) ?></p>
                    <a href="product.php?id=<?= $p['product_id'] ?>">View</a>
                    <a href="view_product.php?product_id=<?= $p['product_id'] ?>" class="btn-wishlist">View
                        Product</a>
                    <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>&quantity=1" class="btn-add-to-cart">Add
                        to Cart</a>
                </div>
                <?php endwhile; ?>
            </div>
        </section>


        <section class="featured-section">
            <h2>Featured Accessories</h2>
            <br>
            <div class="product-grid">
                <?php
          $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = 5 LIMIT 5');
          $stmt->execute();
          while ($p = $stmt->fetch()): ?>
                <div class="product-card">
                    <img src="Image/Accessries/<?= sanitize($p['image']) ?>" alt="<?= sanitize($p['name']) ?>" />
                    <h3><?= sanitize($p['name']) ?></h3>
                    <p>$<?= number_format($p['price'], 2) ?></p>
                    <a href="product.php?id=<?= $p['product_id'] ?>">View</a>
                    <a href="view_product.php?product_id=<?= $p['product_id'] ?>" class="btn-wishlist">View
                        Product</a>
                    <a href="add_to_cart.php?product_id=<?= $p['product_id'] ?>&quantity=1" class="btn-add-to-cart">Add
                        to Cart</a>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>

</body>

</html>

<?php include 'includes/footer.php'; ?>