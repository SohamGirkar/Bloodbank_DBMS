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

    // Get form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood-group']);
    $previous_donation = mysqli_real_escape_string($conn, $_POST['previous-donation']);
    $last_donation_sql = !empty($_POST['last-donation']) ? "'".mysqli_real_escape_string($conn, $_POST['last-donation'])."'" : "NULL";
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $donation_date = mysqli_real_escape_string($conn, $_POST['donation-date']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $area = mysqli_real_escape_string($conn, $_POST['area']);
    $hospital = mysqli_real_escape_string($conn, $_POST['hospital']);

    // Handle blood proof PDF upload
    $blood_proof_filename = NULL;
    if(isset($_FILES['blood-proof']) && $_FILES['blood-proof']['error'] == 0){
        $allowed_types = ['application/pdf'];
        $file_type = $_FILES['blood-proof']['type'];

        if(in_array($file_type, $allowed_types)){
            $upload_dir = "uploads/";
            $blood_proof_filename = time() . "_" . basename($_FILES['blood-proof']['name']);
            $target_file = $upload_dir . $blood_proof_filename;

            if(!move_uploaded_file($_FILES['blood-proof']['tmp_name'], $target_file)){
                die("❌ Error uploading file.");
            }
        } else {
            die("❌ Only PDF files are allowed for blood proof.");
        }
    } else {
        die("❌ Blood proof file is required.");
    }

    // Insert into database
    $sql = "INSERT INTO donate_now 
        (fullname, email, phone, gender, age, blood_group, previous_donation, last_donation, address, donation_date, district, area, hospital, blood_proof) 
        VALUES 
        ('$fullname', '$email', '$phone', '$gender', '$age', '$blood_group', '$previous_donation', $last_donation_sql, '$address', '$donation_date', '$district', '$area', '$hospital', '$blood_proof_filename')";

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
                <p>You've been added to our donor registry. Your blood proof will be verified by admin before approval.</p>
                <a href='index.php' class='btn'>Back to Home</a>
            </div>
        </body>
        </html>";
    } else {
        echo "❌ Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
