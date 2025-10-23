<?php
session_start();
include("db.php");

if(isset($_POST['btnlogin'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Use prepared statement
    $stmt = $conn->prepare("SELECT * FROM login_Users WHERE username = ? AND role = 'admin'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        // Check hashed password
        if(password_verify($password, $row['password'])){
            $_SESSION['admin_username'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            echo "<script>alert('❌ Wrong password!');</script>";
        }
    } else {
        echo "<script>alert('❌ Admin user not found!');</script>";
    }
}
?>
