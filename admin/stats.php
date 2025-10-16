<?php
include('../includes/db.php');
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit;
}
$areas = $conn->query("SELECT name, total_slots, available_slots FROM parking_areas");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Parking Statistics</title>
  <link rel="stylesheet" href="../assets/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header class="navbar">
  <div class="logo">Statistics</div>
  <nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_areas.php">Manage Areas</a>
    <a href="view_bookings.php">Bookings</a>
  </nav>
</header>

<section class="stats">
  <canvas id="areaChart" width="400" height="200"></canvas>
</section>

<script>
const ctx = document.getElementById('areaChart');
const data = {
  labels: [<?php
    $names = [];
    while($row = $areas->fetch_assoc()){
      $names[] = $row['name'];
      $total[] = $row['total_slots'];
      $avail[] = $row['available_slots'];
    }
    echo "'" . implode("','", $names) . "'";
  ?>],
  datasets: [{
    label: 'Total Slots',
    data: [<?= implode(",", $total) ?>],
    backgroundColor: 'rgba(10, 147, 150, 0.5)',
  },
  {
    label: 'Available Slots',
    data: [<?= implode(",", $avail) ?>],
    backgroundColor: 'rgba(148, 210, 189, 0.7)',
  }]
};

new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {responsive: true}
});
</script>
</body>
</html>
