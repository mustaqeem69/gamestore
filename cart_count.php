<?php
session_start();

header('Content-Type: application/json');

$totalItems = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
    }
}

echo json_encode(['total' => $totalItems]);
