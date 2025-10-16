<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Register | Smart Car Parking</title>

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
      justify-content: center;
      align-items: center;
      overflow: hidden;
      color: #fff;
      position: relative;
    }

    .container {
      background: rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 45px 50px;
      width: 420px;
      text-align: center;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      position: relative;
      z-index: 2;
    }

    .title {
      font-size: 2rem;
      font-weight: 600;
      color: #fff;
      text-shadow: 0 0 12px rgba(255,255,255,0.4);
      margin-bottom: 10px;
    }

    .subtitle {
      color: #e0f7fa;
      margin-bottom: 25px;
      font-size: 0.95rem;
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
      margin-top: 18px;
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

    /* Decorative static elements */
    .decor {
      position: absolute;
      border-radius: 50%;
      background: rgba(255,255,255,0.15);
      filter: blur(1px);
    }

    .decor.circle1 {
      width: 90px;
      height: 90px;
      top: 10%;
      left: 8%;
    }

    .decor.circle2 {
      width: 60px;
      height: 60px;
      bottom: 15%;
      right: 10%;
    }

    .decor.circle3 {
      width: 40px;
      height: 40px;
      top: 45%;
      right: 20%;
    }

    .decor.circle4 {
      width: 120px;
      height: 120px;
      bottom: 10%;
      left: 15%;
      background: rgba(255,255,255,0.08);
    }

    @media (max-width: 480px) {
      .container {
        width: 90%;
        padding: 35px 25px;
      }
      .title {
        font-size: 1.7rem;
      }
    }
  </style>
</head>

<body>

  <!-- Static decorative background -->
  <div class="decor circle1"></div>
  <div class="decor circle2"></div>
  <div class="decor circle3"></div>
  <div class="decor circle4"></div>

  <div class="container">
    <h1 class="title">📝 User Registration</h1>
    <p class="subtitle">Create your account to book a parking slot easily.</p>

    <form action="register_action.php" method="POST" class="form-box">
  <input type="text" name="name" placeholder="Full Name" required />
  <input type="email" name="email" placeholder="Email Address" required />
  <input type="password" name="password" placeholder="Password" required />
  <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Register</button>
  <p class="link-text">Already have an account? <a href="login.php">Login here</a></p>
</form>

  </div>

</body>
</html>
