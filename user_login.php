<?php
// Start session if none exists
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header('Location: user_dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<?php include 'includes/header.php'; ?>

<h2>User Login</h2>

<div class="login-form" style="max-width: 400px; margin: auto;">
    <form action="user_login.php" method="post">
        <label for="username">Username:</label><br/>
        <input type="text" id="username" name="username" required /><br/><br/>

        <label for="password">Password:</label><br/>
        <input type="password" id="password" name="password" required /><br/><br/>

        <button type="submit" name="login">Login</button>
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <p>Don't have an account? <a href="user_registration.php">Register here</a></p>
</div>

<?php include 'includes/footer.php'; ?>
