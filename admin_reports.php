<!-- admin_reports.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access denied.");
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Reports - GameStore</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="p-4">
  <h2>Sales Reports 📊</h2>

  <form class="mb-3" method="GET">
    <label for="reportType">Select Report:</label>
    <select name="report" id="reportType" class="form-select w-25">
      <option value="sales">Total Sales by Game</option>
      <option value="revenue">Total Revenue</option>
    </select>
    <button type="submit" class="btn btn-primary mt-2">Generate</button>
  </form>

  <div id="report-output">
    <?php
    if (isset($_GET['report'])) {
        $report = $_GET['report'];

        if ($report == 'sales') {
            $sql = "SELECT games.name, COUNT(orders.id) as total_sales 
                    FROM orders 
                    JOIN games ON orders.game_id = games.id 
                    GROUP BY games.name";
            $result = $conn->query($sql);

            $labels = [];
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['name'];
                $data[] = $row['total_sales'];
            }

            echo "<canvas id='salesChart' width='400' height='200'></canvas>";
            echo "<script>
                const ctx = document.getElementById('salesChart');
                new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: " . json_encode($labels) . ",
                    datasets: [{
                      label: 'Total Sales',
                      data: " . json_encode($data) . ",
                      backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    }]
                  }
                });
            </script>";
        } elseif ($report == 'revenue') {
            $sql = "SELECT SUM(games.price) AS revenue 
                    FROM orders 
                    JOIN games ON orders.game_id = games.id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo "<div class='alert alert-success'>Total Revenue: R" . $row['revenue'] . "</div>";
        }
    }
    ?>
  </div>
</body>
</html>
