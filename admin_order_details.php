<?php
session_start();
include("includes/db.php");
include("includes/header.php");

// Get Order ID
$order_id = intval($_GET['id']);

// Fetch the order details
$order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();

// Fetch ordered games
$items = $conn->query("SELECT oi.*, g.title FROM order_items oi JOIN games g ON oi.game_id = g.id WHERE order_id = $order_id");
?>

<div class="container">
    <h2 class="text-center my-4">Order #<?= $order['id']; ?> Details</h2>

    <p><strong>Customer:</strong> <?= $order['name']; ?></p>
    <p><strong>Email:</strong> <?= $order['email']; ?></p>
    <p><strong>Total Paid:</strong> R<?= number_format($order['total_price'], 2); ?></p>

    <h4 class="mt-4">Games Purchased:</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Game Title</th>
                <th>Quantity</th>
                <th>Price (each)</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $items->fetch_assoc()) { ?>
                <tr>
                    <td><?= $item['title']; ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td>R<?= number_format($item['price'], 2); ?></td>
                    <td>R<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="admin_orders.php" class="btn btn-secondary">Back to Orders</a>
</div>

<?php include("includes/footer.php"); ?>
