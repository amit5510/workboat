<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Dashboard - Workboat Media</title>
<link rel="stylesheet" href="../assets/css/style.css" />
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}
.container {
    margin-left: 200px;
    padding: 20px;
}
.sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 180px;
    height: 100%;
    background-color: #2c3e50;
    padding-top: 20px;
}
.sidebar a {
    display: block;
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    transition: background 0.3s;
}
.sidebar a:hover {
    background-color: #34495e;
}
.header {
    background-color: #f4f4f4;
    padding: 10px 20px;
    border-bottom: 1px solid #ccc;
}
</style>
</head>
<body>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="upload.php">Upload Gallery</a>
    <a href="careers.php">Manage Careers</a>
    <a href="contacts.php">View Contacts</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="header">
        <h2>Admin Dashboard - Workboat Media Pvt. Ltd.</h2>
        <p>Welcome, <strong><?= htmlspecialchars($_SESSION['admin']); ?></strong></p>
    </div>

    <p>Select an option from the menu to manage the website.</p>
</div>

</body>
</html>
