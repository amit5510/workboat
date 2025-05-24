<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: user_login.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<h1>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
<p>This is your user dashboard.</p>

<a href="logout.php">Logout</a>

<?php include 'includes/footer.php'; ?>
