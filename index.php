<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GameStore 🎮</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1b2838;
      color: #c7d5e0;
      font-family: Arial, sans-serif;
    }
    .navbar {
      background-color: #171a21;
    }
    .navbar-brand, .nav-link {
      color: #c7d5e0 !important;
    }
    .hero {
      background: url('https://store.cloudflare.steamstatic.com/public/shared/images/joinsteam/new_login_bg_strong_mask.jpg') center center/cover no-repeat;
      height: 60vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }
    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
      text-shadow: 0 0 10px #000;
    }
    .game-card {
      background-color: #2a475e;
      border: none;
      transition: transform 0.2s;
    }
    .game-card:hover {
      transform: scale(1.03);
    }
    .game-card img {
      object-fit: cover;
      height: 180px;
    }
    .footer {
      background-color: #171a21;
      padding: 20px 0;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">GameStore</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="store.php">Store</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero">
  <div>
    <h1>Welcome to GameStore 🎮</h1>
    <p>Discover. Play. Trade.</p>
    <a href="store.php" class="btn btn-primary btn-lg mt-3">Browse Games</a>
  </div>
</div>

<!-- Featured Games -->
<div class="container py-5">
  <h2 class="mb-4 text-white">Featured Games</h2>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card game-card">
        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/730/header.jpg" class="card-img-top" alt="CS:GO">
        <div class="card-body">
          <h5 class="card-title text-white">Counter-Strike: GO</h5>
          <a href="store.php" class="btn btn-outline-light btn-sm">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card game-card">
        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/271590/header.jpg" class="card-img-top" alt="GTA V">
        <div class="card-body">
          <h5 class="card-title text-white">GTA V</h5>
          <a href="store.php" class="btn btn-outline-light btn-sm">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card game-card">
        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/252490/header.jpg" class="card-img-top" alt="Rust">
        <div class="card-body">
          <h5 class="card-title text-white">Rust</h5>
          <a href="store.php" class="btn btn-outline-light btn-sm">View</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<div class="footer text-center text-light">
  <div class="container">
    <p>&copy; <?= date("Y") ?> GameStore. Inspired by Steam.</p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
