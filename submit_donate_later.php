<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Harsh@2886";
$dbname = "bloodbank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data safely
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood-group']);
    $previous_donation = mysqli_real_escape_string($conn, $_POST['previous-donation']);

    // ✅ Handle empty date properly
    $last_donation = !empty($_POST['last-donation']) ? mysqli_real_escape_string($conn, $_POST['last-donation']) : NULL;
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // ✅ Handle file upload
    if (isset($_FILES['blood-proof']) && $_FILES['blood-proof']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = time() . "_" . basename($_FILES["blood-proof"]["name"]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["blood-proof"]["tmp_name"], $target_file);
    } else {
        die("Error uploading file.");
    }

    // ✅ Use prepared statement (handles NULL properly)
    $stmt = $conn->prepare("
        INSERT INTO donate_later 
        (fullname, email, phone, gender, age, blood_group, previous_donation, last_donation, address, blood_proof, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
    ");

    $stmt->bind_param(
        "ssssisssss",
        $fullname,
        $email,
        $phone,
        $gender,
        $age,
        $blood_group,
        $previous_donation,
        $last_donation,
        $address,
        $file_name
    );

    if ($stmt->execute()) {
        // ✅ Success page
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
                <p>You've been added to our donor registry. We'll contact you when blood is urgently needed. Thank you for your willingness to help save lives!</p>
                <a href='index.php' class='btn'>Back to Home</a>
            </div>
        </body>
        </html>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
