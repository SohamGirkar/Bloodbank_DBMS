
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
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (full_name, email, phone_number, subject, message) 
            VALUES ('$full_name', '$email', '$phone_number', '$subject', '$message')";
}



 if ($conn->query($sql) === TRUE) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Thank You - LifeShare</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
                    background: url("images/servicesbg.png") no-repeat center center fixed;
                    color: #0c0b0bff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    text-align: center;
                }
                .thank-you-box {
                    background: rgba(255, 255, 255, 0.1);
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.4);
                    max-width: 600px;
                    backdrop-filter: blur(10px);
                }
                .thank-you-box i {
                    font-size: 60px;
                    color: #b62137ff;
                    margin-bottom: 20px;
                }
                .thank-you-box h2 {
                    font-size: 28px;
                    margin-bottom: 15px;
                }
                .thank-you-box p {
                    font-size: 18px;
                    margin-bottom: 25px;
                }
                .btn {
                    display: inline-block;
                    padding: 12px 25px;
                    background: #fff;
                    color: #d32f2f;
                    border-radius: 8px;
                    text-decoration: none;
                    font-weight: bold;
                    transition: 0.3s;
                }
                .btn:hover {
                    background: #ffcdd2;
                    color: #b71c1c;
                }
            </style>
        </head>
        <body>
            <div class="thank-you-box">
                <i class="fa-solid fa-heart-circle-check"></i>
                <h2>✅ Thank You, <?php echo htmlspecialchars($full_name); ?>!</h2>
                <p>Your information has been saved successfully❤️</p>
                <p>Our team will soon reach you.</p>
                <a href="index.php" class="btn">Back to Home</a>
               
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "❌ Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>



