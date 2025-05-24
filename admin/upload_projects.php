<?php
session_start();
include '../includes/db.php';

// Check if admin is logged in, otherwise redirect (you can skip login as per your request)
if (!isset($_SESSION['admin_logged_in'])) {
    // header('Location: login.php');
    // exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/';
        $filename = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Insert into DB
            $stmt = $pdo->prepare("INSERT INTO projects (title, description, image) VALUES (?, ?, ?)");
            if ($stmt->execute([$title, $description, $filename])) {
                $message = "Project uploaded successfully!";
            } else {
                $message = "Database error.";
            }
        } else {
            $message = "Failed to upload image.";
        }
    } else {
        $message = "Please select an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Project</title>
</head>
<body>
<h2>Upload Project</h2>
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Project Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Project Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Upload</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
