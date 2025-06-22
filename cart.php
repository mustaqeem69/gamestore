<?php
session_start();
include("db.php");
include("header.php");

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

// Remove an item from the cart if the remove button is clicked
if (isset($_GET['remove_id'])) {
    $remove_id = intval($_GET['remove_id']);
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]); // Remove the item from the cart
    }
    header('Location: cart.php'); // Redirect back to the cart page after removing the item
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🛒 Your Cart | GameStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1b2838;
      color: #c7d5e0;
    }
    .cart-card {
      background-color: #2a475e;
      padding: 2rem;
      border-radius: 10px;
      margin-top: 2rem;
    }
    .btn-back {
      background-color: #4c6b8a;
      color: white;
    }
    .btn-back:hover {
      background-color: #3b5773;
    }
    .footer {
      background-color: #171a21;
      padding: 20px 0;
      margin-top: 40px;
    }
    .btn-remove {
      background-color: #e74c3c;
      color: white;
      border: none;
    }
    .btn-remove:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mt-4">
    <h2>Your Cart 🛍️</h2>
    <a href="store.php" class="btn btn-back">🔙 Back to Store</a>
  </div>

  <div class="cart-card mt-4">
    <?php if (empty($cart)): ?>
      <p>Your cart is empty. <a href="store.php" class="text-info">Browse games</a> to add items.</p>
    <?php else: ?>
      <ul class="list-group mb-4">
        <?php foreach ($cart as $game_id => $item): 
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
        ?>
          <li class="list-group-item d-flex justify-content-between align-items-center bg-dark text-light">
            <?= htmlspecialchars($item['title']); ?> x <?= $item['quantity']; ?>
            <span>R<?= number_format($subtotal, 2); ?></span>
            <a href="cart.php?remove_id=<?= $game_id ?>" class="btn-remove btn-sm">❌ Remove</a>
          </li>
        <?php endforeach; ?>
      </ul>

      <h5 class="text-warning">💳 Total: R<?= number_format($total, 2); ?></h5>

      <a href="checkout.php" class="btn btn-success mt-3">✅ Proceed to Checkout</a>
    <?php endif; ?>
  </div>
</div>

<!-- Floating Cart Icon -->
<a href="cart.php" class="cart-float">
  🛒 <span id="cart-count"><?= array_sum(array_column($cart, 'quantity')); ?></span>
</a>

<div class="footer text-center text-light">
  <p>&copy; <?= date("Y") ?> GameStore. All rights reserved.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .cart-float {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #198754;
    color: white;
    padding: 10px 15px;
    border-radius: 30px;
    font-weight: bold;
    z-index: 999;
    text-decoration: none;
  }
</style>
</body>
</html>
