<?php include 'includes/header.php'; ?>

<h2>Admin Login</h2>

<form action="admin_login.php" method="post">
    <label for="adminuser">Admin Username:</label><br/>
    <input type="text" id="adminuser" name="adminuser" required /><br/>

    <label for="adminpass">Password:</label><br/>
    <input type="password" id="adminpass" name="adminpass" required /><br/>

    <button type="submit" name="adminlogin">Login</button>
</form>

<?php
session_start();

if (isset($_POST['adminlogin'])) {
    $adminuser = $_POST['adminuser'];
    $adminpass = $_POST['adminpass'];

    // Hardcoded admin login - change this to proper DB auth for production
    if ($adminuser === 'admin' && $adminpass === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<p>Invalid admin credentials.</p>";
    }
}
?>

<?php include 'includes/footer.php'; ?>
