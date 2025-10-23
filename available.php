<?php
include "db.php"; // database connection

// ✅ Fetch only donors who selected "later"
$query = "
SELECT fullname, age, gender, blood_group, address 
FROM donate_now 
WHERE status != 'fulfilled'
UNION ALL
SELECT fullname, age, gender, blood_group, address 
FROM donate_later 
WHERE status != 'fulfilled'
";


$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Blood</title>
    <link rel="stylesheet" href="available.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body class="available-page">
 <!-- Navigation Bar -->
    <header>
         <nav>
            <div class="logo">LifeShare</div>
            <ul class="nav-links" >
                <li><a href="index.php">Home</a></li>
                <li><a href="find_donors.php">Find Donors</a></li>
                <li><a href="AI.html"><i class="fas fa-robot"></i> Ask AI</a></li>
                 <li><a href="donation_centres.html">Donation Centres</a></li>
                <li><a href="#service">Services
                    <ul class="menu">
                    <li><a href="donate_now.html">Donate Now</a></li>
                    <li><a href="donate_later.html">Donate Later</a></li>
                    <li><a href="request.html">Request Blood</a></li>
                    <li><a href="available.php">Available Blood</a></li>
                    <li><a href="compatibility.php">Compatibility</a></li>
                    </ul>
                </a></li>
                <li><a href="index.php #contact">Contact</a></li>
                <!-- 🚨 Emergency Button -->
                <li><a href="emergency.php" class="emergency-btn">Emergency</a></li>
            </ul>
        </nav>
    </header>

<main>
    <div class="wrapper">
        <div class="header-area">
            <h2>LifeShare</h2>
            <h3>Available Blood</h3>
            <p>Find the donors you need, when you need them</p>
        </div>

        <!-- Buttons to navigate -->
        <div class="action-buttons">
            <a href="donate_now.html" class="btn donate-btn"><i class="fa-solid fa-hand-holding-droplet"></i> Donate Now</a>
            <a href="request.html" class="btn request-btn"><i class="fa-solid fa-droplet"></i> Request Blood</a>
        </div>

        <div class="cards-container">
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="card">
                            <h3>'.$row['fullname'].'</h3>
                            <p><i class="fa-solid fa-mars-and-venus"></i> '.$row['gender'].'</p>
                            <p><i class="fa-solid fa-droplet"></i> Blood: '.$row['blood_group'].'</p>
                            
                            <p><i class="fa-solid fa-location-dot"></i> '.$row['address'].'</p>
                          </div>';
                }
            } else {
                echo "<p class='no-donors'>No donors available</p>";
            }
            ?>
        </div>
    </div>
</main>
</body>
</html>
