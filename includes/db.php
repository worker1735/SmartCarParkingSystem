<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>
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
