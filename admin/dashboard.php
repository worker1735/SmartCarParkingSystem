<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>

<?php
include('../includes/db.php');
session_start();

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to index.php if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit;
}

// --- Add Parking Area ---
if (isset($_POST['add_area'])) {
    $name = $_POST['name'];
    $total = $_POST['total_slots'];
    $available = $_POST['available_slots'];
    $location = $_POST['location'];

    mysqli_query($conn, "INSERT INTO parking_areas (name, total_slots, available_slots, location) 
                        VALUES ('$name', '$total', '$available', '$location')");
    echo "<script>alert('✅ Parking area added successfully!'); window.location='dashboard.php';</script>";
}

// --- Delete Area ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM parking_areas WHERE id='$id'");
    echo "<script>alert('🗑️ Area deleted'); window.location='dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Smart Car Parking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{margin:0;padding:0;font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#00c6ff,#0072ff);color:#fff;overflow-x:hidden;}
.sidebar{width:250px;height:100vh;background:rgba(0,0,0,0.3);backdrop-filter:blur(10px);position:fixed;top:0;left:0;display:flex;flex-direction:column;padding:30px 15px;}
.sidebar h2{text-align:center;color:#00ffcc;font-size:1.4rem;margin-bottom:30px;text-shadow:0 0 10px #00ffcc;}
.sidebar a{text-decoration:none;color:#fff;margin:10px 0;padding:10px 15px;border-radius:8px;transition:all 0.3s ease;display:block;}
.sidebar a:hover{background:#00ffcc;color:#003f5c;}
.main-content{margin-left:260px;padding:30px;}
h1{text-shadow:0 0 10px rgba(255,255,255,0.4);}
.stats{display:flex;flex-wrap:wrap;gap:20px;margin-top:20px;}
.stat-box{background:rgba(255,255,255,0.1);padding:20px 25px;border-radius:15px;backdrop-filter:blur(10px);box-shadow:0 4px 15px rgba(0,0,0,0.3);width:250px;text-align:center;}
.stat-box h3{color:#00ffcc;}
form{background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);padding:25px;border-radius:15px;width:400px;margin-top:40px;}
input{width:100%;padding:10px 15px;border-radius:30px;border:none;margin-bottom:15px;outline:none;}
button{background:#00ffcc;color:#003f5c;border:none;padding:10px 15px;border-radius:30px;font-weight:600;cursor:pointer;transition:0.3s;width:100%;}
button:hover{transform:translateY(-3px);box-shadow:0 4px 10px rgba(0,0,0,0.3);}
table{width:100%;border-collapse:collapse;margin-top:40px;background:rgba(255,255,255,0.1);border-radius:10px;overflow:hidden;}
th,td{padding:12px 15px;text-align:center;border-bottom:1px solid rgba(255,255,255,0.2);}
th{background:rgba(0,0,0,0.3);color:#00ffcc;}
a.delete-btn{color:red;text-decoration:none;font-weight:bold;}
footer{text-align:center;margin-top:40px;opacity:0.8;font-size:0.9rem;}
footer span{color:#00ffcc;font-weight:600;}
.timing-table{margin-top:60px;}
</style>
</head>
<body>

<div class="sidebar">
  <h2>🚗 Smart Parking</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="../check_availability.php">User View</a>
  <a href="logout.php" style="margin-top:auto;background:#ff4c4c;">Logout</a>
</div>

<div class="main-content">
<h1>Welcome, Admin 👋</h1>

<div class="stats">
<?php 
  $total = mysqli_query($conn, "SELECT SUM(total_slots) AS total FROM parking_areas");
  $available = mysqli_query($conn, "SELECT SUM(available_slots) AS available FROM parking_areas");
  $t = mysqli_fetch_assoc($total)['total'] ?? 0;
  $a = mysqli_fetch_assoc($available)['available'] ?? 0;
?>
<div class="stat-box"><h3>Total Slots</h3><p><?php echo $t; ?></p></div>
<div class="stat-box"><h3>Available Slots</h3><p><?php echo $a; ?></p></div>
<div class="stat-box"><h3>Occupied Slots</h3><p><?php echo $t - $a; ?></p></div>
</div>

<form method="POST">
<h2>Add New Parking Area</h2>
<input type="text" name="name" placeholder="Area Name (e.g. A1)" required>
<input type="number" name="total_slots" placeholder="Total Slots" required>
<input type="number" name="available_slots" placeholder="Available Slots" required>
<input type="text" name="location" placeholder="Location" required>
<button type="submit" name="add_area">Add Area</button>
</form>

<table>
<tr>
<th>ID</th>
<th>Area Name</th>
<th>Total Slots</th>
<th>Available</th>
<th>Location</th>
<th>Action</th>
</tr>
<?php 
$result = mysqli_query($conn, "SELECT * FROM parking_areas");
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['total_slots']}</td>
    <td>{$row['available_slots']}</td>
    <td>{$row['location']}</td>
    <td><a class='delete-btn' href='?delete={$row['id']}'>Delete</a></td>
  </tr>";
}
?>
</table>

<h2 class="timing-table">📋 User Booking History</h2>
<table>
<tr>
<th>Booking ID</th>
<th>User ID</th>
<th>User Name</th>
<th>Area</th>
<th>Start Time</th>
<th>End Time</th>
<th>Status</th>
</tr>
<?php
$history = mysqli_query($conn, "
    SELECT b.id AS booking_id, b.user_id, u.name AS user_name, a.name AS area_name, 
           b.start_time, 
           IF(b.end_time='0000-00-00 00:00:00', NULL, b.end_time) AS end_time, 
           b.status
    FROM bookings b
    JOIN parking_areas a ON b.area_id = a.id
    JOIN users u ON b.user_id = u.id
    ORDER BY b.id DESC
");
if(mysqli_num_rows($history) > 0){
    while($row = mysqli_fetch_assoc($history)){
        echo "<tr>
            <td>{$row['booking_id']}</td>
            <td>{$row['user_id']}</td>
            <td>{$row['user_name']}</td>
            <td>{$row['area_name']}</td>
            <td>{$row['start_time']}</td>
            <td>".($row['end_time'] ? $row['end_time'] : '-')."</td>
            <td>{$row['status']}</td>
        </tr>";
    }
}else{
    echo "<tr><td colspan='7'>No bookings yet.</td></tr>";
}
?>
</table>

<footer>
© 2025 <span>Smart Car Parking System</span> — All Rights Reserved 🚘
</footer>
</div>

</body>
</html>
