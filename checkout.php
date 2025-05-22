<?php
require_once 'includes/functions.php';
include 'includes/header.php';
redirectIfNotLoggedIn();

// 1. جلب بيانات السلة
$stmt = $pdo->prepare(
    'SELECT c.product_id, p.price, c.quantity
     FROM cart c
     JOIN products p ON c.product_id = p.product_id
     WHERE c.user_id = ?'
);
$stmt->execute([$_SESSION['user_id']]);
$items = $stmt->fetchAll();

if (empty($items)) {
    echo '<p>Your cart is empty.</p>';
    include 'includes/footer.php';
    exit;
}

$total = 0;
foreach ($items as $it) {
    $total += $it['price'] * $it['quantity'];
}

// 2. عند الضغط على الدفع
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_method = $_POST['payment_method'] ?? 'credit_card'; // default

    $pdo->beginTransaction();
    $pdo->prepare(
        'INSERT INTO orders(user_id, total_amount) VALUES(?, ?)'
    )->execute([$_SESSION['user_id'], $total]);
    $order_id = $pdo->lastInsertId();

    $stmt_item = $pdo->prepare(
        'INSERT INTO order_items(order_id, product_id, quantity, price)
         VALUES(?, ?, ?, ?)'
    );
    foreach ($items as $it) {
        $stmt_item->execute([
            $order_id,
            $it['product_id'],
            $it['quantity'],
            $it['price']
        ]);
    }

    // حفظ الدفع
    $pdo->prepare(
        'INSERT INTO payments(order_id, user_id, amount, payment_method)
         VALUES(?, ?, ?, ?)'
    )->execute([$order_id, $_SESSION['user_id'], $total, $payment_method]);

    // تفريغ السلة
    $pdo->prepare('DELETE FROM cart WHERE user_id = ?')
        ->execute([$_SESSION['user_id']]);
    $pdo->commit();

   echo "<h2>Order #{$order_id} completed successfully — Total: \${$total}</h2>";




 

    
    exit;
}
?>

<!-- 3. واجهة الدفع -->
<link rel="stylesheet" href="css/style_payment.css">

<div class="payment-container">
    <h2>Payment Information</h2>

    <div class="order-summary">
        <h3>Order Summary</h3>
        <p><strong>Total Amount:</strong> $<?= $total ?></p>
    </div>

    <div class="payment-method">
        <h3>Select Payment Method</h3>
        <form method="POST">
            <label for="payment_method">Choose Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>

            <div class="payment-details">
                <div class="credit-card-details" style="display: none;">
                    <label for="card_number">Card Number:</label>
                    <input type="text" name="card_number" id="card_number" placeholder="Enter your card number" required>

                    <label for="expiry_date">Expiry Date:</label>
                    <input type="month" name="expiry_date" id="expiry_date" required>

                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv" id="cvv" placeholder="Enter CVV" required>
                </div>

                <div class="paypal-details" style="display: none;">
                    <label for="paypal_email">PayPal Email:</label>
                    <input type="email" name="paypal_email" id="paypal_email" placeholder="Enter your PayPal email" required>
                </div>

                <div class="bank-transfer-details" style="display: none;">
                    <h4>Bank Transfer Details</h4>
                    <p><strong>Bank Name:</strong> Bank of Tech</p>
                    <p><strong>Account Number:</strong> 1234567890</p>
                    <p><strong>IBAN:</strong> GB29NWBK60161331926819</p>
                    <p><strong>SWIFT/BIC:</strong> NWBKGB2L</p>
                    <p><strong>Important:</strong> Include your order ID in transfer reference.</p>
                </div>
            </div>

            <button type="submit" class="payment-btn">Confirm and Pay</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function () {
        var selectedMethod = this.value;

        var cardFields = document.querySelector('.credit-card-details');
        var paypalFields = document.querySelector('.paypal-details');
        var bankFields = document.querySelector('.bank-transfer-details');

        cardFields.style.display = 'none';
        paypalFields.style.display = 'none';
        bankFields.style.display = 'none';

        cardFields.querySelectorAll('input').forEach(input => input.required = false);
        paypalFields.querySelectorAll('input').forEach(input => input.required = false);

        if (selectedMethod === 'credit_card') {
            cardFields.style.display = 'block';
            cardFields.querySelectorAll('input').forEach(input => input.required = true);
        } else if (selectedMethod === 'paypal') {
            paypalFields.style.display = 'block';
            paypalFields.querySelectorAll('input').forEach(input => input.required = true);
        } else if (selectedMethod === 'bank_transfer') {
            bankFields.style.display = 'block';
        }
    });

    // ✅ تشغيل السكريبت أول ما الصفحة تفتح
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('payment_method').dispatchEvent(new Event('change'));
    });
</script>

<?php include 'includes/footer.php'; ?>
