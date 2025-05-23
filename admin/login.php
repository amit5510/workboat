<?php
session_start();

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminUser = $_POST['username'] ?? '';
    $adminPass = $_POST['password'] ?? '';

    if ($adminUser === 'admin' && $adminPass === 'admin123') {
        $_SESSION['admin'] = $adminUser;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid admin credentials';
    }
}
?>

<?php include 'includes/header_public.php'; ?>

<div class="container" style="max-width: 400px; margin: auto;">
    <h2 style="text-align:center;">Admin Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label><br/>
        <input type="text" name="username" id="username" required /><br/><br/>

        <label for="password">Password:</label><br/>
        <input type="password" name="password" id="password" required /><br/><br/>

        <button type="submit" style="width: 100%;">Login</button>
    </form>

    <?php if ($error): ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>

<?php include 'includes/footer_public.php'; ?>
