<?php
include('config.php');  // path project structure ke hisaab se adjust kare
?>

<?php 
include('../includes/db.php'); 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Smart Car Parking</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      height: 100vh;
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      color: #fff;
    }

    /* Floating background bubbles */
    body::before, body::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.15);
      animation: float 6s ease-in-out infinite alternate;
    }
    body::before { top: -80px; left: -80px; width: 300px; height: 300px; }
    body::after { bottom: -100px; right: -80px; width: 250px; height: 250px; }

    @keyframes float {
      from { transform: translateY(0px); }
      to { transform: translateY(40px); }
    }

    .form-container {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      padding: 40px 50px;
      border-radius: 25px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      text-align: center;
      width: 350px;
      animation: fadeIn 1s ease;
      position: relative;
      z-index: 2;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      margin-bottom: 20px;
      text-shadow: 0 0 10px rgba(255,255,255,0.6);
    }

    input {
      width: 100%;
      padding: 12px 15px;
      border: none;
      border-radius: 30px;
      margin-bottom: 18px;
      font-size: 1rem;
      outline: none;
      transition: box-shadow 0.3s ease;
    }

    input:focus {
      box-shadow: 0 0 10px #00ffcc;
    }

    button {
      background: #00ffcc;
      color: #003f5c;
      border: none;
      padding: 12px 18px;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
    }

    button:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    .toggle {
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .toggle a {
      color: #00ffcc;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .toggle a:hover {
      text-decoration: underline;
    }

    footer {
      position: absolute;
      bottom: 15px;
      text-align: center;
      width: 100%;
      color: rgba(255,255,255,0.8);
      font-size: 0.9rem;
      letter-spacing: 0.5px;
      text-shadow: 0 0 5px rgba(255,255,255,0.3);
    }

    footer span {
      color: #00ffcc;
      font-weight: 600;
    }

    /* Smooth switch animation */
    .hidden { display: none; }
  </style>
</head>
<body>

  <div class="form-container">
    <div id="loginForm">
      <h2>🔑 Admin Login</h2>
      <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
      </form>
      <div class="toggle">
        <p>Don't have an account? <a href="#" onclick="toggleForm()">Register here</a></p>
      </div>
    </div>

    <div id="registerForm" class="hidden">
      <h2>📝 Admin Register</h2>
      <form method="POST">
        <input type="text" name="r_username" placeholder="Username" required>
        <input type="password" name="r_password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
      </form>
      <div class="toggle">
        <p>Already registered? <a href="#" onclick="toggleForm()">Login here</a></p>
      </div>
    </div>
  </div>

  <footer>
    © 2025 <span>Smart Car Parking System</span> — All Rights Reserved 🚘
  </footer>

  <script>
    function toggleForm() {
      document.getElementById('loginForm').classList.toggle('hidden');
      document.getElementById('registerForm').classList.toggle('hidden');
    }
  </script>

<?php
// --- LOGIN ---
if (isset($_POST['login'])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $query = "SELECT * FROM admins WHERE username='$user' AND password='$pass'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['admin'] = $user;
    echo "<script>alert('Welcome, $user!'); window.location='dashboard.php';</script>";
  } else {
    echo "<script>alert('❌ Invalid credentials');</script>";
  }
}

// --- REGISTER ---
if (isset($_POST['register'])) {
  $r_user = $_POST['r_username'];
  $r_pass = $_POST['r_password'];

  $check = mysqli_query($conn, "SELECT * FROM admins WHERE username='$r_user'");
  if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('⚠️ Username already exists!');</script>";
  } else {
    mysqli_query($conn, "INSERT INTO admins (username, password) VALUES ('$r_user', '$r_pass')");
    echo "<script>alert('✅ Registration successful! You can now login.');</script>";
  }
}
?>

</body>
</html>
