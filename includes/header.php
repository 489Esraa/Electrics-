<?php require_once __DIR__ . '/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" href="css/c.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/style.css">
    <title>Tech Corner</title>
</head>
<body>
<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="Phone.php">Phone</a>
        <a href="Laptop.php">Laptop</a>
        <a href="Tablet.php">Tablet</a>
        <a href="Watch.php">Watch</a>
        <a href="Accssiors.php">Accssories</a>
        <?php if(isLoggedIn()): ?>
            <a href="about.php">About Us</a>
            <a href="cart.php">Cart</a>
            <a href="account.php">My Account</a>
            <?php if(isAdmin()): ?><a href="admin/index.php">Admin</a><?php endif; ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<main>
