<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include("includes/header.php");
?>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['user']['name']; ?> 👋</h2>
    <p>This is your user dashboard. Enjoy shopping for games!</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<?php include("footer.php"); ?>
