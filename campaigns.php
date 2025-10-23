<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Campaigns - LifeShare</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100">

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

<main class="container mx-auto px-4 py-12 mt-20">
    <h2 class="text-3xl font-bold text-center mb-8">📅 All Upcoming Campaigns</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $sql = "SELECT * FROM campaigns WHERE date >= CURDATE() ORDER BY date ASC";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='bg-white rounded-lg shadow-lg border-l-4 border-red-600 p-6 hover:shadow-xl transition-shadow duration-300'>
                        <h3 class='text-xl font-semibold mb-2'>{$row['title']}</h3>
                        <p class='text-gray-700 mb-2'>{$row['description']}</p>
                        <p class='text-gray-600 mb-1'><i class='fas fa-calendar-alt mr-2 text-red-600'></i><strong>Date:</strong> {$row['date']}</p>
                        <p class='text-gray-600 mb-1'><i class='fas fa-clock mr-2 text-red-600'></i><strong>Time:</strong> {$row['time']}</p>
                        <p class='text-gray-600'><i class='fas fa-map-marker-alt mr-2 text-red-600'></i><strong>Location:</strong> {$row['location']}</p>
                      </div>";
            }
        } else {
            echo "<p class='text-center text-gray-700 col-span-full'>No upcoming campaigns at the moment.</p>";
        }
        ?>
    </div>
</main>


<footer>
        <div class="container">
            <div class="footer-content grid grid-cols-4">
                <div class="footer-section">
                    <h3>LifeShare</h3>
                    <p>Dedicated to saving lives through blood donation. Every donation makes a difference.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="index.html #why-donate">Why Donate</a></li>
                        <li><a href="find_donors.php">Find Donors</a></li>
                        <li><a href="AI.html">Eligibility</a></li>
                        <li><a href="index.html #procedure">Process</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="donation_centres.html">Donation Centers</a></li>
                        <li><a href="campaigns.php">Blood Drive Events</a></li>
                        <!-- <li><a href="#">Educational Materials</a></li> -->
                        <li><a href="AI.html">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="index.html #contact">Contact Us</a></li>
                        <li><a href="emergency.php">Emergency Services</a></li>
                        <!-- <li><a href="#">Volunteer</a></li> -->
                        <li><a href="donate_now.html">Donate</a></li>
                    </ul>
                </div>
            </div>
            <p>&copy; 2025 LifeShare Blood Donation Center. All rights reserved.</p>
        </div>
    </footer>
   
</body>
</html>