<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>

<?php
include('../includes/db.php');
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit;
}
$total_areas = $conn->query("SELECT COUNT(*) AS total FROM parking_areas")->fetch_assoc()['total'];
$total_bookings = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header class="navbar">
  <div class="logo">🚗 Admin Dashboard</div>
  <nav>
    <a href="dashboard.php">Home</a>
    <a href="manage_areas.php">Manage Areas</a>
    <a href="view_bookings.php">Bookings</a>
    <a href="stats.php">Statistics</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>

<section class="stats">
  <div class="card">
    <h3>Total Areas</h3>
    <p><?= $total_areas ?></p>
  </div>
  <div class="card">
    <h3>Total Bookings</h3>
    <p><?= $total_bookings ?></p>
  </div>
  <div class="card">
    <h3>Registered Users</h3>
    <p><?= $total_users ?></p>
  </div>
</section>
</body>
</html>
