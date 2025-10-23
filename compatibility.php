<?php
include "db.php"; // database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Compatibility - LifeShare</title>
    <link rel="stylesheet" href="find_donor.css"> <!-- reuse your existing CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <header>
         <nav>
            <div class="logo">LifeShare</div>
            <ul class="nav-links">
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
    <section class="compatibility-section">
        <div class="wrapper">
            <h2 id="blood-search">🩸 Blood Compatibility Checker</h2>

            <!-- Compatibility Table -->
            <table class="compatibility-table">
                <tr>
                    <th>Donor Blood Group</th>
                    <th>Can Donate To</th>
                    <th>Can Receive From</th>
                </tr>
                <tr>
                    <td>A+</td>
                    <td>A+, AB+</td>
                    <td>A+, A-, O+, O-</td>
                </tr>
                <tr>
                    <td>A-</td>
                    <td>A+, A-, AB+, AB-</td>
                    <td>A-, O-</td>
                </tr>
                <tr>
                    <td>B+</td>
                    <td>B+, AB+</td>
                    <td>B+, B-, O+, O-</td>
                </tr>
                <tr>
                    <td>B-</td>
                    <td>B+, B-, AB+, AB-</td>
                    <td>B-, O-</td>
                </tr>
                <tr>
                    <td>AB+</td>
                    <td>AB+</td>
                    <td>Everyone</td>
                </tr>
                <tr>
                    <td>AB-</td>
                    <td>AB+, AB-</td>
                    <td>A-, B-, AB-, O-</td>
                </tr>
                <tr>
                    <td>O+</td>
                    <td>O+, A+, B+, AB+</td>
                    <td>O+, O-</td>
                </tr>
                <tr>
                    <td>O-</td>
                    <td>Everyone</td>
                    <td>O-</td>
                </tr>
            </table>

            <!-- Optional No Result Message -->
            <p class="no-compatibility-result" style="display:none;">❌ No compatibility found.</p>
        </div>
    </section>
</main>

</body>
</html>
