<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>
<?php
include('includes/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Check if user already exists
  $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    echo "<script>
      alert('⚠️ This email is already registered. Please login instead.');
      window.location='login.php';
    </script>";
    exit;
  }

  // Insert new user
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $hashed_password);
  $stmt->execute();

  // Get new user ID
  $user_id = $conn->insert_id;

  // Store user session
  $_SESSION['user_id'] = $user_id;
  $_SESSION['user_name'] = $name;

  // Check available parking slots in real-time
  $slots = mysqli_query($conn, "SELECT * FROM parking_areas WHERE available_slots > 0");

  if(mysqli_num_rows($slots) > 0){
    $_SESSION['available_slots'] = [];
    while($row = mysqli_fetch_assoc($slots)){
      $_SESSION['available_slots'][] = $row;
    }
    // Redirect to slots page
    header("Location: slots.php");
    exit;
  } else {
    echo "<script>
      alert('⚠️ Sorry, no parking slots are currently available.');
      window.location='login.php';
    </script>";
  }

  $stmt->close();
  $conn->close();
}
?>

 