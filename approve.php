<?php
include("db.php");

$table = $_GET['table'];
$id = $_GET['id'];

// Validate table name to prevent SQL injection
if($table === 'donate_now' || $table === 'donate_later'){
    mysqli_query($conn, "UPDATE $table SET status='approved' WHERE id=$id");
}

header("Location: admin_dashboard.php");
exit;
?>
