<?php
include "db.php"; // database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Donors - LifeShare</title>
    <link rel="stylesheet" href="find_donor.css">
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
    <div class="wrapper">
        <h2 id="blood-search">🔎 Find Blood Donors</h2>

        <!-- Search Form -->
        <form method="POST" action="">
            <label for="blood_group">Select Blood Group:</label>
            <select name="blood_group" required>
                <option value="">-- Select --</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <label for="location">Location:</label>
            
<select name="location">
    <option value="">-- Select --</option>
    <option value="Andheri">Andheri</option>
    <option value="Bandra">Bandra</option>
    <option value="Dadar">Dadar</option>
    <option value="Borivali">Borivali</option>
    <option value="Thane">Thane</option>
    <option value="Ghatkopar">Ghatkopar</option>
    <option value="Malad">Malad</option>
    <option value="Colaba">Colaba</option>
</select>


            <button type="submit" name="search">Search</button>
        </form>

        <hr>

        <!-- Search Results -->
        <?php
        if (isset($_POST['search'])) {
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // Query ONLY from donate_later
    $sql = "SELECT fullname AS name, age, gender, blood_group, phone, address 
            FROM donate_later 
            WHERE blood_group='$blood_group'";

    if (!empty($location)) {
        $sql .= " AND address LIKE '%$location%'";
    }

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<h3>✅ Matching Donors Found:</h3>";
        echo "<table>";
        echo "<tr><th>Name</th><th>Age</th><th>Gender</th><th>Blood Group</th><th>Contact</th><th>Address</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['blood_group']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['address']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>❌ No donors found for $blood_group in $location.</p>";
    }
}
        ?>
    </div>
</main>

</body>
</html>
