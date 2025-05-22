<?php
include 'includes/header.php';

$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(empty($_POST['name']))                   $errors[] = 'Name required';
    if(empty($_POST['email']))
                                                $errors[] = 'Valid email required';
    if(strlen($_POST['password'])<6)            $errors[] = 'Password too short';
    if(empty($errors)){
        $hash = $_POST['password'];
        $stmt = $pdo->prepare(
          'INSERT INTO users(name,email,password,role)
           VALUES(?,?,?,?)'
        );
        $stmt->execute([
          $_POST['name'],
          $_POST['email'],
          $hash,
          'customer'
        ]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Login - MyStore</title>

    <style>
    .form-box {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-box h2 {
        text-align: center;
        margin-bottom: 15px;
        color: #333;
    }

    .form-box input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    .form-box .btn {
        width: 100%;
        padding: 12px;
        background-color: teal;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
    }

    .form-box .btn:hover {
        background-color: darkcyan;
    }

    .form-box p {
        text-align: center;
        margin-top: 15px;
    }

    .form-box a {
        color: teal;
        text-decoration: none;
    }

    .form-box a:hover {
        text-decoration: underline;
    }

    .form-box img {
        display: block;
        width: 60px;
        margin: 0 auto 15px;
        opacity: 0.7;
    }
    </style>
</head>

<body>



    <!-- Login Form -->
    <main class="form-box">

        <h2>Login to Your Account</h2>
        <form method="POST">

            <input type="name" name="name" placeholder="User Name" required />
            <input type="email" name="email" placeholder="Email Address" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password_Corrent" placeholder="Password Current" required />
            <button type="submit" class="btn">Login</button>
            <p>Don't have an account? <a href="login.php">Login Here</a></p>
        </form>
    </main>

</body>

</html>

<?php include 'includes/footer.php'; ?>