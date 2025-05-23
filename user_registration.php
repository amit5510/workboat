<?php
// Start session if not started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = 'Please fill in all fields.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Username already taken.';
        } else {
            // Insert new user with hashed password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $success = 'Registration successful! You can now <a href="user_login.php">login</a>.';
            } else {
                $error = 'Error registering user. Please try again.';
            }
        }
        $stmt->close();
    }
}
?>

<?php include 'includes/header.php'; ?>

<h2>User Registration</h2>

<div class="registration-form" style="max-width: 400px; margin: auto;">
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php elseif ($success): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>

    <form action="user_registration.php" method="post">
        <label for="username">Username:</label><br/>
        <input type="text" id="username" name="username" required /><br/><br/>

        <label for="password">Password:</label><br/>
        <input type="password" id="password" name="password" required /><br/><br/>

        <label for="confirm_password">Confirm Password:</label><br/>
        <input type="password" id="confirm_password" name="confirm_password" required /><br/><br/>

        <button type="submit" name="register">Register</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
