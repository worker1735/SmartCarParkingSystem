<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "smart_parking";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}
?>
