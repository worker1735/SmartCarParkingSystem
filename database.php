<?php
$servername = "localhost";
$username = "root";   // your DB username
$password = "";       // your DB password
$dbname = "smart_parking";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
