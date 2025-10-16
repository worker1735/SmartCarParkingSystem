<?php
session_start();
include('includes/db.php');

// If not logged in, redirect
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Fetch available slots
$slots_result = mysqli_query($conn, "SELECT * FROM parking_areas");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Available Parking Slots</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#00c6ff,#0072ff);color:#fff;margin:0;padding:0;}
.container{max-width:900px;margin:50px auto;padding:20px;background:rgba(255,255,255,0.1);backdrop-filter:blur(12px);border-radius:15px;text-align:center;}
h1{margin-bottom:20px;}
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{padding:12px;border-bottom:1px solid rgba(255,255,255,0.2);}
th{color:#00ffcc;}
button{padding:8px 15px;border:none;border-radius:20px;background:#00ffcc;color:#003f5c;font-weight:600;cursor:pointer;}
button:hover{background:#00bfa5;}
.logout{position:absolute;top:20px;right:20px;padding:10px 15px;background:#ff4c4c;color:#fff;border-radius:20px;text-decoration:none;}
</style>
</head>
<body>
<a class="logout" href="logout.php">Logout</a>
<div class="container">
<h1>Welcome, <?php echo $_SESSION['user_name']; ?> 🚗</h1>
<table>
<tr>
<th>Area Name</th>
<th>Total Slots</th>
<th>Available Slots</th>
<th>Location</th>
<th>Action</th>
</tr>
<?php
while($row = mysqli_fetch_assoc($slots_result)){
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['total_slots']}</td>";
    echo "<td>{$row['available_slots']}</td>";
    echo "<td>{$row['location']}</td>";
    if($row['available_slots']>0){
        echo "<td><a href='book.php?area_id={$row['id']}'><button>Book</button></a></td>";
    } else {
        echo "<td>Full</td>";
    }
    echo "</tr>";
}
?>
</table>
</div>
</body>
</html>
