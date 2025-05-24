<?php
// Start session for login handling if needed
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Workboat Media Pvt Ltd</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
<header>
    <div class="container">
        <h1><a href="index.php">Workboat Media Pvt Ltd</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="career.php">Career</a></li>
                <li><a href="team.php">Team</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <?php if(isset($_SESSION['user'])): ?>
                    <li><a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user']); ?>)</a></li>
                <?php else: ?>
                    <li><a href="user_login.php">User Login</a></li>
                <?php endif; ?>
                <li><a href="admin/login.php">Admin Login</a></li>
            </ul>
        </nav>
    </div>
</header>
<main class="container">
