<?php
include "db.php";
session_start();

if (isset($_POST['register'])) {
   
    $fullname    = mysqli_real_escape_string($conn, $_POST['name']);
    $username    = mysqli_real_escape_string($conn, $_POST['username']);
    $email       = mysqli_real_escape_string($conn, $_POST['email']);
    $password    = $_POST['password'];
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $locations   = implode(",", $_POST['locations']);

    
    $check_query = "SELECT id FROM login_Users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('❌ Username or Email already exists. Please try again.');</script>";
    } else {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO login_Users(fullname, username, email, password, blood_group, locations) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $username, $email, $hashed_pass, $blood_group, $locations);

        if (mysqli_stmt_execute($stmt)) {
            echo "
            <style>
              body {
                font-family: Arial, sans-serif;
                background: #f4f7f9;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
              }
              .thankyou-box {
                background: #ffffff;
                padding: 40px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 6px 20px rgba(0,0,0,0.1);
                animation: fadeIn 0.8s ease-in-out;
              }
              .thankyou-box h1 {
                color: #4CAF50;
                margin-bottom: 15px;
              }
              .thankyou-box p {
                color: #555;
                font-size: 16px;
                margin: 8px 0;
              }
              .login-btn {
                display: inline-block;
                margin-top: 15px;
                padding: 10px 20px;
                background: #d32f2f;
                color: #fff;
                text-decoration: none;
                border-radius: 6px;
                transition: 0.3s;
              }
              .login-btn:hover {
                background: #b71c1c;
              }
              @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
              }
            </style>

            <div class='thankyou-box'>
              <h1>✅ Thank You for Registering!</h1>
              <p>Your account has been created successfully.</p>
              <a href='login.php' class='login-btn'>Go to Login</a>
            </div>
            ";
            exit;
        } else {
            echo "❌ Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 400px;
      max-width: 90%;
      margin: 120px auto 50px;
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #d32f2f;
    }
    .input-box {
      margin-bottom: 20px;
    }
    .input-box label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      font-size: 14px;
    }
    .input-box input,
    .input-box select {
      width: 100%;
      padding: 12px 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      box-sizing: border-box;
    }
    .input-box small {
      font-size: 12px;
      color: #777;
    }
    button {
      width: 100%;
      padding: 14px;
      background: #d32f2f;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      transition: 0.3s;
    }
    button:hover {
      background: #b71c1c;
    }
    .link {
      text-align: center;
      margin-top: 18px;
    }
    .link a {
      color: #d32f2f;
      text-decoration: none;
    }
    .link a:hover {
      text-decoration: underline;
    }

    /* Header/Navbar */
    header {
        background: linear-gradient(135deg, #d32f2f, #b71c1c);
        color: white;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 5%;
        max-width: 1200px;
        margin: 0 auto;
    }
    .logo {
        font-size: 1.8rem;
        font-weight: bold;
        color: white;
        margin: 0;
    }
    .nav-links {
        display: flex;
        list-style: none;
        align-items: center;
        gap: 15px;
    }
    .nav-links li { position: relative; }
    .nav-links a {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 4px;
        transition: 0.3s;
    }
    .nav-links a:hover {
        color: #ffcdd2;
        background: rgba(255, 255, 255, 0.1);
    }
    /* Submenu styling */
    .has-submenu { position: relative; }
    .submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #d32f2f;
        list-style: none;
        padding: 10px;
        border-radius: 0 0 5px 5px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        min-width: 180px;
        z-index: 1001;
    }
    .has-submenu:hover .submenu { display: block; animation: fadeIn 0.3s ease; }
    .submenu li { margin: 5px 0; }
    .submenu a { display: block; padding: 8px 12px; border-radius: 4px; white-space: nowrap; }
    .submenu a:hover { background: rgba(255, 255, 255, 0.2); }

    .emergency-btn {
        background-color: #e63946;
        color: #fff !important;
        font-weight: bold;
        padding: 8px 15px;
        border-radius: 8px;
        transition: 0.3s ease;
    }
    .emergency-btn:hover {
        background-color: #b71c1c;
        transform: scale(1.05);
    }

    /* Mobile */
    #menu-toggle { display: none; }
    .hamburger { display: none; flex-direction: column; cursor: pointer; }
    .hamburger span { width: 25px; height: 3px; background: white; margin: 3px 0; }
    @media (max-width: 900px) {
        .hamburger { display: flex; }
        .nav-links {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            flex-direction: column;
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
            padding: 20px;
            gap: 15px;
            transform: translateY(-120%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        #menu-toggle:checked ~ .nav-links {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
        .submenu { position: static; width: 100%; }
    }
  </style>
</head>
<body>

<header>
    <nav>
        <div class="logo">LifeShare</div>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="find_donors.php">Find Donors</a></li>
            <li><a href="AI.html">Ask AI</a></li>
            <li><a href="donation_centres.html">Donation Centres</a></li>
            <li class="has-submenu">
                <a href="#">Services</a>
                <ul class="submenu">
                    <li><a href="donate_now.html">Donate Now</a></li>
                    <li><a href="donate_later.html">Donate Later</a></li>
                    <li><a href="request.html">Request Blood</a></li>
                    <li><a href="available.php">Available Blood</a></li>
                    <li><a href="compatibility.php">Compatibility</a></li>
                </ul>
            </li>
            <li><a href="index.php #contact">Contact</a></li>
            <li><a href="emergency.php" class="emergency-btn">Emergency</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>Create Account</h2>
    <form method="POST" action="register.php">
      <div class="input-box">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="input-box">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-box">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-box">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="input-box">
        <label for="blood_group">Blood Group</label>
        <select id="blood_group" name="blood_group" required>
          <option value="">Select Blood Group</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
        </select>
      </div>
      <div class="input-box">
        <label for="locations">Preferred Donation Locations</label>
        <select id="locations" name="locations[]" multiple required>
          <option value="Andheri">Andheri</option>
          <option value="Bandra">Bandra</option>
          <option value="Dadar">Dadar</option>
          <option value="Borivali">Borivali</option>
          <option value="Thane">Thane</option>
          <option value="Ghatkopar">Ghatkopar</option>
          <option value="Malad">Malad</option>
          <option value="Colaba">Colaba</option>

        </select>
        <small>Hold CTRL (or Command on Mac) to select multiple</small>
      </div>
      <button type="submit" name="register">Register</button>
    </form>
    <div class="link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
</div>

</body>
</html>
