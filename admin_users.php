<?php
session_start();
include("includes/db.php");
include("includes/header.php");

// Fetch all users
$users = $conn->query("SELECT * FROM users");

?>

<div class="container">
    <h2 class="text-center my-4">Manage Users</h2>

    <a href="admin_create_user.php" class="btn btn-primary mb-3">Create New User</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['role']; ?></td>
                    <td>
                        <a href="admin_edit_user.php?id=<?= $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin_delete_user.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>
