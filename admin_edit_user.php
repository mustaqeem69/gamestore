<?php
session_start();
include("includes/db.php");
include("includes/header.php");

$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update user details
    $query = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id";
    if ($conn->query($query) === TRUE) {
        echo "<div class='alert alert-success'>User updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<div class="container">
    <h2 class="text-center my-4">Edit User: <?= $user['name']; ?></h2>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role">
                <option value="customer" <?= ($user['role'] == 'customer') ? 'selected' : ''; ?>>Customer</option>
                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Update User</button>
    </form>
</div>

<?php include("includes/footer.php"); ?>
