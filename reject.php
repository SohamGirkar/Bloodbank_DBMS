<?php
include("db.php");

$table = $_GET['table'];
$id = $_GET['id'];

if($table === 'donate_now' || $table === 'donate_later'){
    mysqli_query($conn, "UPDATE $table SET status='rejected' WHERE id=$id");
}

header("Location: admin_dashboard.php");
exit;
?>
