<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>
<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['user_email']) || !isset($_GET['slot_id'])) {
    header("Location: slots.php");
    exit;
}

$slot_id = $_GET['slot_id'];

// Fetch booking and slot details
$booking = mysqli_fetch_assoc(mysqli_query($conn, 
    "SELECT b.*, s.slot_number 
     FROM bookings b 
     JOIN parking_slots s ON b.slot_id = s.id 
     WHERE b.slot_id='$slot_id' AND b.user_id='{$_SESSION['user_id']}' 
     ORDER BY b.id DESC LIMIT 1"));

if (!$booking) {
    echo "<script>alert('Booking not found'); window.location='slots.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Confirmation</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#00c6ff,#0072ff);color:#fff;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;}
.container{background:rgba(255,255,255,0.1);backdrop-filter:blur(12px);border-radius:20px;padding:40px 50px;text-align:center;box-shadow:0 8px 30px rgba(0,0,0,0.3);}
h1{color:#00ffcc;margin-bottom:20px;}
p{margin:8px 0;}
a{display:inline-block;margin-top:20px;padding:10px 20px;background:#00ffcc;color:#003f5c;border-radius:30px;text-decoration:none;font-weight:600;}
a:hover{background:#00bfa5;}
</style>
</head>
<body>
<div class="container">
<h1>✅ Slot Booked Successfully!</h1>
<p><strong>Slot Number:</strong> <?php echo $booking['slot_number']; ?></p>
<p><strong>Booking ID:</strong> <?php echo $booking['id']; ?></p>
<p><strong>Vehicle Number:</strong> <?php echo $booking['vehicle_no']; ?></p>
<p><strong>Status:</strong> <?php echo $booking['status']; ?></p>
<a href="slots.php">Back to Slots</a>
</div>
</body>
</html>
