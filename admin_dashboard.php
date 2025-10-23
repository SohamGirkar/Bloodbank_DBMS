<?php
session_start();
include("db.php");

// Check if admin is logged in
if(!isset($_SESSION['admin_username'])){
    header("Location: admin_login.php");
    exit;
}

// Handle Approve / Reject actions
if(isset($_GET['action']) && isset($_GET['id']) && isset($_GET['type'])){
    $id = intval($_GET['id']);
    $type = $_GET['type']; // donate_now or donate_later
    if($_GET['action'] === 'approve'){
        $status = 'approved';
    } elseif($_GET['action'] === 'reject'){
        $status = 'rejected';
    }

    if(isset($status)){
        $stmt = $conn->prepare("UPDATE $type SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_dashboard.php");
        exit;
    }
}

// Fetch pending donors
$pending_now = $conn->query("SELECT * FROM donate_now WHERE status='pending'");
$pending_later = $conn->query("SELECT * FROM donate_later WHERE status='pending'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - LifeShare</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
body {
    font-family: Arial, sans-serif;
    margin:0; padding:0;
    background: #f5f5f5;
}
header {
    background: #8a0303; color:white; padding:15px;
}
header h1 { margin:0; }
.container { padding:20px; }
.table { width:100%; border-collapse: collapse; margin-bottom:30px; }
.table th, .table td { border:1px solid #ccc; padding:10px; text-align:center; }
.table th { background:#cc0000; color:white; }
.btn {
    padding:5px 10px;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    text-decoration:none;
}
.approve { background:green; }
.reject { background:red; }
h2 { color:#8a0303; margin-top:40px; }
.logout-btn { float:right; background:#333; color:white; padding:8px 15px; text-decoration:none; border-radius:5px; }
</style>
</head>
<body>

<header>
<h1>Admin Dashboard</h1>
<a href="admin_logout.php" class="logout-btn">Logout</a>
</header>

<div class="container">

<h2>Pending Donate Now Requests</h2>
<table class="table">
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Blood Group</th><th>Last Donation</th><th>Address</th><th>Action</th>
</tr>
<?php while($row = $pending_now->fetch_assoc()): ?>
<tr>
<td><?= $row['id']; ?></td>
<td><?= htmlspecialchars($row['fullname']); ?></td>
<td><?= htmlspecialchars($row['email']); ?></td>
<td><?= htmlspecialchars($row['phone']); ?></td>
<td><?= $row['blood_group']; ?></td>
<td><?= $row['last_donation']; ?></td>
<td><?= htmlspecialchars($row['address']); ?></td>
<td>
<a href="admin_dashboard.php?action=approve&id=<?= $row['id']; ?>&type=donate_now" class="btn approve">Approve</a>
<a href="admin_dashboard.php?action=reject&id=<?= $row['id']; ?>&type=donate_now" class="btn reject">Reject</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<h2>Pending Donate Later Requests</h2>
<table class="table">
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Blood Group</th><th>Previous Donation</th><th>Last Donation</th><th>Address</th><th>Action</th>
</tr>
<?php while($row = $pending_later->fetch_assoc()): ?>
<tr>
<td><?= $row['id']; ?></td>
<td><?= htmlspecialchars($row['fullname']); ?></td>
<td><?= htmlspecialchars($row['email']); ?></td>
<td><?= htmlspecialchars($row['phone']); ?></td>
<td><?= $row['blood_group']; ?></td>
<td><?= $row['previous_donation']; ?></td>
<td><?= $row['last_donation']; ?></td>
<td><?= htmlspecialchars($row['address']); ?></td>
<td>
<a href="admin_dashboard.php?action=approve&id=<?= $row['id']; ?>&type=donate_later" class="btn approve">Approve</a>
<a href="admin_dashboard.php?action=reject&id=<?= $row['id']; ?>&type=donate_later" class="btn reject">Reject</a>
</td>
</tr>
<?php endwhile; ?>
</table>

</div>
</body>
</html>
