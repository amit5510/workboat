<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'includes/header.php';
?>

<h2>Admin Dashboard</h2>
<p>Welcome, Admin! Here you can manage the website content.</p>

<ul>
    <li><a href="career_applications.php">View Career Applications</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<?php include 'includes/footer.php'; ?>
