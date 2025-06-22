<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if (!empty($_SESSION['cart'])) {
    $total = 0;

    // Calculate total price
    foreach ($_SESSION['cart'] as $game_id => $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    }

    // Insert into orders table
    $conn->query("INSERT INTO orders (user_id, order_date, total_amount) VALUES ($user_id, NOW(), $total)");
    $order_id = $conn->insert_id;

    // Insert each item into order_items table
    foreach ($_SESSION['cart'] as $game_id => $item) {
        $conn->query("INSERT INTO order_items (order_id, game_id, quantity) VALUES ($order_id, {$item['game_id']}, {$item['quantity']})");
    }

    // Clear cart after checkout
    $_SESSION['cart'] = [];

    $message = "Thank you for your purchase! Your order has been placed successfully.";
} else {
    $message = "Your cart is empty.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout | GameStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1b2838;
      color: #c7d5e0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .card {
      background-color: #2a475e;
      padding: 3rem;
      border: none;
      text-align: center;
    }
    .btn-home {
      background-color: #66c0f4;
      border: none;
    }
    .btn-home:hover {
      background-color: #4aa3d9;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2><?= $message ?></h2>
    <?php if ($message === "Thank you for your purchase! Your order has been placed successfully."): ?>
      <a href="index.php" class="btn btn-home mt-3">🏠 Back to Home</a>
    <?php else: ?>
      <a href="store.php" class="btn btn-secondary mt-3">🛒 Return to Store</a>
    <?php endif; ?>
  </div>
</body>
</html>
