<?php
session_start();
include("includes/db.php");

// Get User ID
$id = $_GET['id'];

// Delete user
$query = "DELETE FROM users WHERE id = $id";
if ($conn->query($query) === TRUE) {
    echo "<div class='alert alert-success'>User deleted successfully.</div>";
    header("Location: admin_users.php");
} else {
    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
}
?>
