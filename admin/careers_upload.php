<?php include 'includes/header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);

    if ($title && $location && $description) {
        $stmt = $conn->prepare("INSERT INTO careers (title, location, description) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $title, $location, $description);

        if ($stmt->execute()) {
            $message = "Job opening added successfully.";
        } else {
            $message = "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - Upload Career</title>
<link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
<div class="container">
    <h2>Admin - Add Career Opening</h2>

    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="title">Job Title:</label><br />
        <input type="text" id="title" name="title" required /><br /><br />

        <label for="location">Location:</label><br />
        <input type="text" id="location" name="location" required /><br /><br />

        <label for="description">Job Description:</label><br />
        <textarea id="description" name="description" rows="6" required></textarea><br /><br />

        <button type="submit">Add Job</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
