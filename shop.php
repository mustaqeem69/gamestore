<?php include("db.php"); ?>
<?php include("header.php"); ?>

<div class="container">
    <h2>All Games</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM games";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()):
        ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <p class="card-text"><strong>R<?php echo number_format($row['price'], 2); ?></strong></p>
                        <button class="btn btn-success">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include("footer.php"); ?>
