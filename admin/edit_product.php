<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
include '../includes/header.php';
if(empty($_GET['id'])) header('Location: products.php');
$prod = $pdo->prepare('SELECT * FROM products WHERE product_id=?');
$prod->execute([$_GET['id']]);
$p = $prod->fetch();
$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $stmt = $pdo->prepare(
      'UPDATE products
         SET name=?,description=?,price=?,category_id=?,stock=?,image=?
       WHERE product_id=?'
    );
    $stmt->execute([
      $_POST['name'],
      $_POST['description'],
      $_POST['price'],
      $_POST['category_id'],
      $_POST['stock'],
      $_POST['image'],
      $_GET['id']
    ]);
    header('Location: products.php');
    exit;
}
?>
<h2>Edit Product</h2>
<form method="post">
    <input name="name" value="<?= sanitize($p['name']) ?>" required>
    <textarea name="description"><?= sanitize($p['description']) ?></textarea>
    <input name="price" type="number" step="0.01" value="<?= $p['price'] ?>" required>
    <select name="category_id">
        <?php foreach($categories as $c): ?>
            <option value="<?= $c['category_id'] ?>"
              <?= $c['category_id']==$p['category_id']?'selected':'' ?>>
              <?= sanitize($c['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input name="stock" type="number" value="<?= $p['stock'] ?>" required>
    <input name="image" value="<?= sanitize($p['image']) ?>">
    <button class="btn-primary">Update</button>
</form>
<?php include '../includes/footer.php'; ?>
