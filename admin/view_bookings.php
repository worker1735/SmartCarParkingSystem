<?php
include('../includes/db.php');
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Bookings</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header class="navbar">
  <div class="logo">Bookings</div>
  <nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="manage_areas.php">Manage Areas</a>
    <a href="stats.php">Stats</a>
  </nav>
</header>

<section class="availability">
  <h2>All Bookings</h2>
  <table>
    <tr><th>ID</th><th>User</th><th>Area</th><th>Vehicle No</th><th>Date & Time</th><th>Status</th></tr>
    <?php
    $sql = "SELECT b.id, u.name, p.name AS area, b.vehicle_no, b.date_time, b.status 
            FROM bookings b 
            JOIN users u ON b.user_id = u.id
            JOIN parking_areas p ON b.area_id = p.id
            ORDER BY b.date_time DESC";
    $res = $conn->query($sql);
    while($row = $res->fetch_assoc()){
      echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['area']}</td>
        <td>{$row['vehicle_no']}</td>
        <td>{$row['date_time']}</td>
        <td>{$row['status']}</td>
      </tr>";
    }
    ?>
  </table>
</section>
</body>
</html>
