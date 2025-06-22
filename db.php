<?php
$servername = "sql312.infinityfree.com"; // Use the provided host name from InfinityFree
$username = "if0_38851889"; // Use your database username
$password = "mustaqeem01"; // Use your database password
$dbname = "if0_38851889_ecommerce_db"; // Use your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
