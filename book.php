<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>
<?php
session_start();
include('includes/db.php');

// Redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// --- Handle Booking ---
if(isset($_GET['book_area'])){
    $area_id = $_GET['book_area'];

    // Check if user already has an active booking
    $check = mysqli_query($conn, "SELECT * FROM bookings WHERE user_id=$user_id AND status='Active'");
    if(mysqli_num_rows($check) == 0){
        // Reduce available slots
        mysqli_query($conn, "UPDATE parking_areas SET available_slots = available_slots - 1 WHERE id=$area_id");

        // Insert booking with start_time as now
        $start_time = date('Y-m-d H:i:s');
        mysqli_query($conn, "INSERT INTO bookings (user_id, area_id, start_time, status) 
                             VALUES ($user_id, $area_id, '$start_time', 'Active')");
        echo "<script>alert('✅ Booking successful!'); window.location='book.php';</script>";
    } else {
        echo "<script>alert('❌ You already have an active booking!'); window.location='book.php';</script>";
    }
}

// --- Handle Leaving ---
if(isset($_GET['leave_booking'])){
    $booking_id = $_GET['leave_booking'];

    // Set end_time and mark as completed
    $end_time = date('Y-m-d H:i:s');
    mysqli_query($conn, "UPDATE bookings SET end_time='$end_time', status='Completed' WHERE id=$booking_id");

    // Increase available slots in the area
    $booking = mysqli_query($conn, "SELECT area_id FROM bookings WHERE id=$booking_id");
    $area_id = mysqli_fetch_assoc($booking)['area_id'];
    mysqli_query($conn, "UPDATE parking_areas SET available_slots = available_slots + 1 WHERE id=$area_id");

    echo "<script>alert('✅ You have left the slot.'); window.location='book.php';</script>";
}

// --- Fetch all parking areas ---
$slots_result = mysqli_query($conn, "SELECT * FROM parking_areas");

// --- Fetch user's booking history ---
$history_result = mysqli_query($conn, "
    SELECT b.id, a.name AS area_name, b.start_time, 
           IF(b.end_time='0000-00-00 00:00:00', NULL, b.end_time) AS end_time, 
           IF(b.status='', 'Active', b.status) AS status
    FROM bookings b 
    JOIN parking_areas a ON b.area_id=a.id 
    WHERE b.user_id=$user_id 
    ORDER BY b.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parking Slots | Smart Car Parking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#00c6ff,#0072ff);color:#fff;margin:0;padding:0;}
.container{max-width:900px;margin:50px auto;padding:20px;background:rgba(255,255,255,0.1);backdrop-filter:blur(12px);border-radius:15px;text-align:center;}
h1,h2{margin-bottom:20px;}
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{padding:12px;border-bottom:1px solid rgba(255,255,255,0.2);}
th{color:#00ffcc;}
button,a.button{padding:8px 15px;border:none;border-radius:20px;background:#00ffcc;color:#003f5c;font-weight:600;cursor:pointer;text-decoration:none;}
button:hover,a.button:hover{background:#00bfa5;}
.logout{position:absolute;top:20px;right:20px;padding:10px 15px;background:#ff4c4c;color:#fff;border-radius:20px;text-decoration:none;}
</style>
</head>
<body>
<a class="logout" href="logout.php">Logout</a>
<div class="container">
<h1>Welcome, <?php echo $user_name; ?> 🚗</h1>

<h2>Available Parking Slots</h2>
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
        echo "<td><a class='button' href='?book_area={$row['id']}'>Book</a></td>";
    } else {
        echo "<td>Full</td>";
    }
    echo "</tr>";
}
?>
</table>

<h2>Your Booking History</h2>
<table>
<tr>
<th>Area</th>
<th>Start Time</th>
<th>End Time</th>
<th>Status</th>
<th>Action</th>
</tr>
<?php
while($row = mysqli_fetch_assoc($history_result)){
    echo "<tr>";
    echo "<td>{$row['area_name']}</td>";
    echo "<td>{$row['start_time']}</td>";
    echo "<td>" . ($row['end_time'] ? $row['end_time'] : '-') . "</td>";
    echo "<td>{$row['status']}</td>";
    if($row['status']=='Active'){
        echo "<td><a class='button' href='?leave_booking={$row['id']}'>Leave</a></td>";
    } else {
        echo "<td>-</td>";
    }
    echo "</tr>";
}
?>
</table>

</div>
</body>
</html>
