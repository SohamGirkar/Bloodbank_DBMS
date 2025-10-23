<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "Harsh@2886";
$dbname = "bloodbank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$fullname = $phone = $blood_group = $bags = $district = $area = $urgency = $details = "";
$terms = 0;
$errors = [];

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    if (empty($_POST["fullname"])) {
        $errors[] = "Full name is required";
    } else {
        $fullname = mysqli_real_escape_string($conn, trim($_POST["fullname"]));
    }
    
    if (empty($_POST["phone"])) {
        $errors[] = "Phone number is required";
    } else {
        $phone = mysqli_real_escape_string($conn, trim($_POST["phone"]));
    }
    
    if (empty($_POST["blood-group"])) {
        $errors[] = "Blood group is required";
    } else {
        $blood_group = mysqli_real_escape_string($conn, trim($_POST["blood-group"]));
    }
    
    if (empty($_POST["blood-bags"])) {
        $errors[] = "Number of blood bags is required";
    } else {
        $bags = mysqli_real_escape_string($conn, trim($_POST["blood-bags"]));
    }
    
    if (empty($_POST["district"])) {
        $errors[] = "District is required";
    } else {
        $district = mysqli_real_escape_string($conn, trim($_POST["district"]));
    }
    
    if (empty($_POST["area"])) {
        $errors[] = "Area is required";
    } else {
        $area = mysqli_real_escape_string($conn, trim($_POST["area"]));
    }
    
    if (empty($_POST["urgency"])) {
        $errors[] = "Urgency level is required";
    } else {
        $urgency = mysqli_real_escape_string($conn, trim($_POST["urgency"]));
    }
    
    if (!empty($_POST["details"])) {
        $details = mysqli_real_escape_string($conn, trim($_POST["details"]));
    }
    
    if (empty($_POST["terms"])) {
        $errors[] = "You must agree to the terms and conditions";
    } else {
        $terms = 1;
    }
    
    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO blood_requests_list (fullname, phone, blood_group, bags, district, area, urgency, details, terms) 
                VALUES ('$fullname', '$phone', '$blood_group', '$bags', '$district', '$area', '$urgency', '$details', '$terms')";
        
        if ($conn->query($sql) === TRUE) {
            // Success message
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Thank You - LifeShare</title>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css'>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                    background: linear-gradient(135deg, #8a0303 0%, #cc0000 100%);
                    color: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    text-align: center;
                }
                .thank-you-box {
                    background: rgba(255, 255, 255, 0.95);
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                    max-width: 600px;
                    width: 90%;
                }
                .thank-you-box i {
                    font-size: 60px;
                    color: #cc0000;
                    margin-bottom: 20px;
                }
                .thank-you-box h2 {
                    font-size: 28px;
                    margin-bottom: 15px;
                    color: #cc0000;
                }
                .thank-you-box p {
                    font-size: 18px;
                    margin-bottom: 25px;
                    color: #333;
                }
                .btn {
                    display: inline-block;
                    padding: 12px 25px;
                    background: linear-gradient(135deg, #cc0000 0%, #8a0303 100%);
                    color: white;
                    border-radius: 8px;
                    text-decoration: none;
                    font-weight: bold;
                    transition: 0.3s;
                }
                .btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
                }
            </style>
        </head>
        <body>
            <div class='thank-you-box'>
                <i class='fa-solid fa-heart-circle-check'></i>
                <h2>Thank You, " . htmlspecialchars($fullname) . "!</h2>
                <p>Your request has been submitted. We'll contact you when blood is ready. Thank You!</p>
                <a href='index.php' class='btn'>Back to Home</a>
            </div>
        </body>
        </html>";
        } else {
            $errors[] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
