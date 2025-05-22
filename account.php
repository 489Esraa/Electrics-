<?php
include 'includes/header.php';
redirectIfNotLoggedIn();

// Secure AJAX profile update with field whitelisting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['field'], $_POST['value'])) {
    $allowedFields = ['name', 'email'];
    $field = $_POST['field'];
    $value = trim($_POST['value']);

    if (in_array($field, $allowedFields)) {
        // Whitelist mapping
        $fieldMap = [
            'name' => 'name',
            'email' => 'email'
        ];
        $column = $fieldMap[$field];

        // Use dynamic column safely
        $stmt = $pdo->prepare("UPDATE users SET {$column} = ? WHERE user_id = ?");
        $stmt->execute([$value, $_SESSION['user_id']]);
        echo json_encode(['success' => true]);
        exit;
    }
    echo json_encode(['success' => false, 'message' => 'Invalid field']);
    exit;
}

// Fetch user info
$stmt_user = $pdo->prepare('SELECT name AS full_name, email FROM users WHERE user_id = ?');
$stmt_user->execute([$_SESSION['user_id']]);
$user = $stmt_user->fetch();

// Fetch orders
$stmt_orders = $pdo->prepare('
    SELECT o.order_id, o.order_date, o.status, 
           p.payment_method, 
           pr.name AS product_name, pr.image, pr.category_id, 
           oi.quantity
    FROM orders o
    JOIN payments p ON o.order_id = p.order_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products pr ON oi.product_id = pr.product_id
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC
');
$stmt_orders->execute([$_SESSION['user_id']]);
$orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

// Helper function
function getProductImage($imageName, $categoryId) {
    if (!$imageName) {
        return "image/default-product.png";
    }

    switch ($categoryId) {
        case 1: $folder = 'laptops'; break;
        case 2: $folder = 'phones'; break;
        case 3: $folder = 'Ipads'; break;
        case 4: $folder = 'watchs'; break;
        case 5: $folder = 'Accessries'; break;
        default: $folder = 'default_category'; break;
    }

    $imagePath = "image/$folder/$imageName";
    return file_exists($imagePath) ? $imagePath : "image/default-product.png";
}
?>

<link rel="stylesheet" href="css/Account.css">
<link rel="stylesheet" href="css/index.css">

<main>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <p><strong>Full Name:</strong> <span class="editable"
                    data-field="name"><?= htmlspecialchars($user['full_name']) ?></span></p>
            <p><strong>Email:</strong> <span class="editable"
                    data-field="email"><?= htmlspecialchars($user['email']) ?></span></p>
        </div>

        <!-- Orders Table -->
        <div class="order-history">
            <h2>My Orders</h2>
            <table class="elegant-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="7">No orders found.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= htmlspecialchars($order['product_name']) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars(getProductImage($order['image'], $order['category_id'])) ?>"
                                alt="<?= htmlspecialchars($order['product_name']) ?>" width="50"
                                onerror="this.onerror=null;this.src='image/default-product.png';">
                        </td>
                        <td><?= htmlspecialchars($order['quantity']) ?></td>
                        <td><?= htmlspecialchars($order['payment_method']) ?></td>
                        <td><?= htmlspecialchars($order['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<style>
.editable:hover {
    cursor: pointer;
    background-color: #f0f0f0;
}

.elegant-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.elegant-table th,
.elegant-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}

.elegant-table th {
    background-color: #007BFF;
    color: white;
}

.elegant-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.profile-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 15px;
}

.profile-info p {
    font-size: 1.1rem;
    margin-bottom: 10px;
}
</style>

<script>
document.querySelectorAll('.editable').forEach(el => {
    el.addEventListener('dblclick', () => {
        const originalText = el.innerText;
        const field = el.dataset.field;
        const input = document.createElement('input');
        input.type = 'text';
        input.value = originalText;
        input.className = 'edit-input';
        el.innerHTML = '';
        el.appendChild(input);
        input.focus();

        input.addEventListener('blur', () => {
            const newValue = input.value.trim();
            if (newValue && newValue !== originalText) {
                fetch(window.location.href, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            field: field,
                            value: newValue
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            el.innerText = newValue;
                        } else {
                            alert('Failed to update. Please try again.');
                            el.innerText = originalText;
                        }
                    })
                    .catch(() => {
                        alert('Network error. Please try again.');
                        el.innerText = originalText;
                    });
            } else {
                el.innerText = originalText;
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                input.blur();
            }
            if (e.key === 'Escape') {
                el.innerText = originalText;
            }
        });
    });
});
</script>

<!-- <?php include 'includes/footer.php'; ?> -->