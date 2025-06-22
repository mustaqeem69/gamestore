<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game Store | Browse Games</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1b2838;
      color: #c7d5e0;
    }
    .navbar {
      background-color: #171a21;
    }
    .navbar-brand, .nav-link {
      color: #c7d5e0 !important;
    }
    .game-card {
      background-color: #2a475e;
      border: none;
      transition: transform 0.2s;
    }
    .game-card:hover {
      transform: scale(1.02);
    }
    .game-card img {
      object-fit: cover;
      height: 180px;
    }
    .footer {
      background-color: #171a21;
      padding: 20px 0;
      margin-top: 40px;
    }
    .cart-float {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #28a745;
      color: white;
      padding: 10px 15px;
      border-radius: 30px;
      font-weight: bold;
      z-index: 999;
      text-decoration: none;
    }
    .back-btn {
      margin-top: 10px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">🎮 GameStore</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Game Store -->
<div class="container py-5">
  <a href="index.php" class="btn btn-outline-light back-btn">⬅ Back</a>
  <h2 class="mb-4 text-white">Available Games</h2>
  <div class="row">

    <?php
    $sql = "SELECT * FROM games";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      echo '
        <div class="col-md-4 mb-4">
          <div class="card game-card">
            <img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">
            <div class="card-body">
              <h5 class="card-title text-white">' . $row['name'] . '</h5>
              <p class="card-text text-light">R' . $row['price'] . '</p>
              <button class="btn btn-outline-light btn-sm add-to-cart-btn" data-id="' . $row['id'] . '">Add to Cart</button>
            </div>
          </div>
        </div>';
    }
    ?>

  </div>
</div>

<!-- Footer -->
<div class="footer text-center text-light">
  <div class="container">
    <p>&copy; <?= date("Y") ?> GameStore. All rights reserved.</p>
  </div>
</div>

<!-- Floating Cart Icon -->
<a href="cart.php" class="cart-float">
  🛒 <span id="cart-count">0</span>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const cartCount = document.getElementById("cart-count");
    const buttons = document.querySelectorAll(".add-to-cart-btn");

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {
            const gameId = this.dataset.id;

            fetch(`add_to_cart.php?id=${gameId}`)
                .then(res => res.json())
                .then(data => {
                    cartCount.innerText = data.total;
                });
        });
    });

    // Load initial cart count
    fetch("cart_count.php")
      .then(res => res.json())
      .then(data => {
          cartCount.innerText = data.total;
      });
});
</script>

</body>
</html>
