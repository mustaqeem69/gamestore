<?php
session_start();
include("includes/db.php");
include("includes/header.php");

// Check if the user is an admin (optional security check)
// if ($_SESSION['role'] != 'admin') {
//     die('Access Denied.');
// }

// Fetch all orders
$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<div class="container">
    <h2 class="text-center my-4">Customer Orders</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>View Items</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $orders->fetch_assoc()) { ?>
                <tr>
                    <td><?= $order['id']; ?></td>
                    <td><?= $order['name']; ?></td>
                    <td><?= $order['email']; ?></td>
                    <td>R<?= number_format($order['total_price'], 2); ?></td>
                    <td><?= $order['created_at']; ?></td>
                    <td><a href="admin_order_details.php?id=<?= $order['id']; ?>" class="btn btn-info btn-sm">View Items</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>
