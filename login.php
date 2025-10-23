<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - LifeShare</title>
    <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">
      <link rel="stylesheet" href="login.css">
      <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <li><a href="AI.html"><i class="fas fa-robot"></i> Ask AI</a></li>
             <li><a href="donation_centres.html">Donation Centres</a></li>
            <li class="has-submenu">
                <a href="#service">Services <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="donate_now.html">Donate Now</a></li>
                    <li><a href="donate_later.html">Donate Later</a></li>
                    <li><a href="request.html">Request Blood</a></li>
                    <li><a href="available.php">Available Blood</a></li>
                    <li><a href="compatibility.php" class="active">Compatibility</a></li>
                </ul>
            </li>
            <li><a href="index.php #contact">Contact</a></li>
            <li><a href="emergency.php" class="emergency-btn">Emergency</a></li>
        </ul>
    </nav>
</header>
  <!-- login -->
       <section id="body_area">
        <div id="content_area">
            <div class="left_side">
                <div class="img_section">
                    <img src="lifesharelogo.png" alt="">
                </div>
                
            </div>
            <div class="form_area">
                <form method="post">
                    <input type="text" placeholder="username" name="username">
                    <input type="password" placeholder="Password" name="password">
                   <button type="submit" class="login-btn" name="btnlogin">Login</button>
                  <a href="donate_now.html">Donate</a>
                  <span class="motivational"> blood today, save a life tomorrow.🩸✨.</span>
                    <hr>
                  
                </form>
                  <p>Want to create a new account? | <a href="register.php">Sign Up</a></p>
            </div>
        </div>
    </section>
        </body>

<?php
session_start(); 
include("db.php");

if(isset($_POST['btnlogin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login_users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row["password"])){
            $_SESSION['username'] = $row['username'];  

         
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('❌ Wrong password!');</script>";
        }
    } else {
        echo "<script>alert('❌ User not found!');</script>";
    }
}
?>
