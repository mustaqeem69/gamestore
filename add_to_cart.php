<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo json_encode(['error' => 'Invalid ID']);
    exit;
}

// Fetch game info from DB
$sql = "SELECT * FROM games WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo json_encode(['error' => 'Game not found']);
    exit;
}

$row = mysqli_fetch_assoc($result);

// Add to cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the game is already in the cart
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity'] += 1; // Increase quantity if the game is already in the cart
} else {
    $_SESSION['cart'][$id] = [
        'game_id' => $row['id'],
        'title' => $row['name'],
        'price' => $row['price'],
        'quantity' => 1
    ];
}

// Count total items in cart
$totalItems = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
}

echo json_encode(['success' => true, 'total' => $totalItems]);
