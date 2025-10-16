<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Login | Smart Car Parking</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      color: #fff;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 40px 50px;
      width: 400px;
      text-align: center;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      position: relative;
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }

    .title {
      font-size: 2rem;
      color: #fff;
      text-shadow: 0 0 12px rgba(255,255,255,0.4);
      margin-bottom: 10px;
    }

    .subtitle {
      color: #e0f7fa;
      margin-bottom: 25px;
    }

    .form-box {
      display: flex;
      flex-direction: column;
    }

    input {
      background: rgba(255, 255, 255, 0.15);
      border: none;
      border-radius: 30px;
      padding: 12px 18px;
      margin: 10px 0;
      color: #fff;
      font-size: 1rem;
      transition: all 0.3s ease;
      outline: none;
    }

    input::placeholder {
      color: rgba(255,255,255,0.7);
    }

    input:focus {
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 0 10px #00ffcc;
    }

    .btn {
      margin-top: 15px;
      background: linear-gradient(135deg, #00ffcc, #00bfa5);
      color: #003f5c;
      border: none;
      border-radius: 30px;
      padding: 12px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 0 10px rgba(0,255,204,0.4);
    }

    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,255,204,0.5);
    }

    .link-text {
      margin-top: 20px;
      color: #e0f7fa;
      font-size: 0.95rem;
    }

    .link-text a {
      color: #00ffcc;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .link-text a:hover {
      color: #fff;
      text-shadow: 0 0 8px #00ffcc;
    }

    footer {
      position: absolute;
      bottom: 15px;
      font-size: 0.9rem;
      opacity: 0.8;
      text-align: center;
    }

    footer p {
      color: #e0f7fa;
    }

    footer span {
      color: #00ffcc;
      font-weight: 600;
    }

    /* Floating icons animation */
    .decor {
      position: absolute;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: rgba(255,255,255,0.2);
      animation: floatIcon 6s ease-in-out infinite;
    }

    .decor:nth-child(1) {
      top: 20%;
      left: 10%;
      animation-delay: 1s;
    }
    .decor:nth-child(2) {
      bottom: 15%;
      right: 12%;
      animation-delay: 2.5s;
    }
    .decor:nth-child(3) {
      top: 40%;
      right: 25%;
      animation-delay: 0.5s;
    }

    @keyframes floatIcon {
      0%,100% { transform: translateY(0); opacity: 0.8; }
      50% { transform: translateY(-15px); opacity: 1; }
    }
  </style>
</head>

<body>

  <!-- Floating decorations -->
  <div class="decor"></div>
  <div class="decor"></div>
  <div class="decor"></div>

  <div class="container">
    <h1 class="title">🚗 User Login</h1>
    <p class="subtitle">Welcome back! Please login to continue.</p>

    <form action="login_action.php" method="POST" class="form-box">
      <input type="email" name="email" placeholder="Enter your email" required />
      <input type="password" name="password" placeholder="Enter your password" required />
      <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Login</button>
      <p class="link-text">Don’t have an account? <a href="register.php">Register here</a></p>
    </form>
  </div>

  <footer>
    <p>© 2025 <span>Smart Car Parking System</span> — All Rights Reserved 🚘</p>
  </footer>

</body>
</html>
