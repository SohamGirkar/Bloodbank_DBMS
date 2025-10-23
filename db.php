<?php
$host = "localhost";   // or "127.0.0.1"
$user = "root";        // default for XAMPP
$pass = "Harsh@2886";            // default empty for XAMPP
$dbname = "bloodbank"; // use your database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
