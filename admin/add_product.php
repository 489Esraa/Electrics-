<?php
require_once '../includes/functions.php';
redirectIfNotAdmin();
include '../includes/header.php';
$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $stmt = $pdo->prepare(
      'INSERT INTO products(name,description,price,category_id,stock,image)
       VALUES(?,?,?,?,?,?)'
    );
    $stmt->execute([
      $_POST['name'],
      $_POST['description'],
      $_POST['price'],
      $_POST['category_id'],
      $_POST['stock'],
      $_POST['image']
    ]);
    header('Location: products.php');
    exit;
}
?>
<h2>Add Product</h2>
<form method="post">
    <input name="name" placeholder="Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input name="price" type="number" step="0.01" placeholder="Price" required>
    <select name="category_id">
        <?php foreach($categories as $c): ?>
            <option value="<?= $c['category_id'] ?>">
              <?= sanitize($c['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input name="stock" type="number" placeholder="Stock" required>
    <input name="image" placeholder="Image filename">
    <button class="btn-primary">Add</button>
</form>
<?php include '../includes/footer.php'; ?>
