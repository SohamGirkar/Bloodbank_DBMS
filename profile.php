<?php
session_start();
include("db.php");

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT * FROM login_Users WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $user['fullname']; ?> - Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Navbar + Page Style -->
  <style>
    /* Reset & Base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: linear-gradient(135deg, #fce4ec, #f3e5f5);
        color: #333;
        line-height: 1.6;
        min-height: 100vh;
        overflow-x: hidden;
        padding-top: 70px; /* space for fixed header */
    }

    /* Header */
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
        padding: 1rem 5%;
        max-width: 1200px;
        margin: 0 auto;
        padding-right: 5px;
        align-items: center;
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
        transition: all 0.3s ease;
        gap: 10px;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: 0.3s;
    }

    .nav-links a:hover {
        color: #ffcdd2;
        background: rgba(255, 255, 255, 0.1);
    }

    /* Submenu styling */
    .has-submenu {
        position: relative;
    }

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

    .has-submenu:hover .submenu {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    .submenu li {
        margin: 5px 0;
    }

    .submenu a {
        display: block;
        padding: 8px 12px;
        border-radius: 4px;
        white-space: nowrap;
    }

    .submenu a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Emergency Button */
    .emergency-btn {
        background-color: #e63946;
        color: #fff !important;
        font-weight: bold;
        padding: 8px 15px;
        border-radius: 8px;
        transition: 0.3s ease;
        text-decoration: none;
    }

    .emergency-btn:hover {
        background-color: #b71c1c;
        transform: scale(1.05);
        color: #fff;
    }

    /* Mobile menu toggle */
    #menu-toggle {
        display: none;
    }

    .hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        padding: 5px;
    }

    .hamburger span {
        width: 25px;
        height: 3px;
        background: white;
        margin: 3px 0;
        transition: 0.3s;
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 900px) {
        .hamburger {
            display: flex;
        }

        .nav-links {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, #d32f2f, #b71c1c);
            flex-direction: column;
            padding: 20px;
            gap: 15px;
            transform: translateY(-100%);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        #menu-toggle:checked ~ .nav-links {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }

        .submenu {
            position: static;
            display: none;
            background: rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            box-shadow: none;
        }

        #menu-toggle:checked ~ .nav-links .submenu {
            display: block;
        }

        .nav-links a {
            width: 100%;
            justify-content: center;
        }
    }

    /* Profile Box */
    .profile-box {
        max-width: 500px; 
        margin: 50px auto; 
        background: white; 
        padding: 30px; 
        border-radius: 20px; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .profile-box h2 { 
        text-align: center; 
        color: #d32f2f; 
        font-size: 26px; 
        margin-bottom: 20px;
    }

    .profile-box p { 
        font-size: 16px; 
        margin: 12px 0; 
        padding: 12px; 
        background: #fafafa; 
        border-left: 4px solid #d32f2f; 
        border-radius: 8px; 
    }

    .profile-box b {
        color: #333; 
    }

    .profile-box a {
        display: block; 
        text-align: center; 
        margin-top: 20px; 
        text-decoration: none; 
        background: #d32f2f; 
        color: white; 
        padding: 12px 20px; 
        border-radius: 8px; 
        font-weight: bold; 
        transition: background 0.3s ease;
    }

    .profile-box a:hover {
        background: #b71c1c; 
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  
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

  <!-- Profile Box -->
  <div class="profile-box">
    <h2>Welcome, <?php echo $user['fullname']; ?> 👋</h2>
    <p><b>Username:</b> <?php echo $user['username']; ?></p>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
    <p><b>Blood Group:</b> <?php echo $user['blood_group']; ?></p>
    <p><b>Donation Locations:</b> <?php echo $user['locations']; ?></p>
    <a href="logout.php">Logout</a>
  </div>

</body>
</html>
