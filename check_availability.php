<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>
<?php
include('includes/db.php');
session_start();

// Fetch only available parking slots
$slots_result = mysqli_query($conn, "SELECT * FROM parking_areas WHERE available_slots > 0 ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Check Availability | Smart Car Parking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body {
    font-family:'Poppins',sans-serif;
    background: linear-gradient(135deg,#00c6ff,#0072ff);
    color:#fff;
    margin:0;
    padding:0;
}
.container {
    max-width:900px;
    margin:50px auto;
    padding:20px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    border-radius:15px;
    text-align:center;
}
h1,h2 {
    margin-bottom:20px;
}
table {
    width:100%;
    border-collapse: collapse;
    margin-top:20px;
}
th, td {
    padding:12px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}
th {
    background: rgba(0,0,0,0.3);
    color: #00ffcc;
}
button, a.button {
    padding:8px 15px;
    border:none;
    border-radius:20px;
    background:#00ffcc;
    color:#003f5c;
    font-weight:600;
    cursor:not-allowed;
    text-decoration:none;
}
button:hover, a.button:hover {
    background:#00ffcc;
}
.logout {
    position:absolute;
    top:20px;
    right:20px;
    padding:10px 15px;
    background:#ff4c4c;
    color:#fff;
    border-radius:20px;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="container">
<h1>📊 Available Parking Slots</h1>
<p class="subtitle">Real-time availability (Login required to book)</p>

<table>
<tr>
<th>Area Name</th>
<th>Total Slots</th>
<th>Available Slots</th>
<th>Location</th>
<th>Action</th>
</tr>

<?php
if(mysqli_num_rows($slots_result) > 0){
    while($row = mysqli_fetch_assoc($slots_result)){
        echo "<tr>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['total_slots']}</td>";
        echo "<td>{$row['available_slots']}</td>";
        echo "<td>{$row['location']}</td>";
        // Book button disabled since user is not logged in
        echo "<td><button disabled>Login to Book</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>🚫 No slots available right now.</td></tr>";
}
?>

</table>
</div>

<footer>
<p>© 2025 Smart Car Parking System | Designed with ❤️ | All Rights Reserved</p>
</footer>

</body>
</html>
