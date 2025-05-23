<?php
session_start();
include '../includes/db.php';

// Check if admin is logged in (optional)
if (!isset($_SESSION['admin_logged_in'])) {
    // header('Location: login.php');
    // exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = $_POST['caption'] ?? '';
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/uploads/';
        $filename = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $stmt = $pdo->prepare("INSERT INTO gallery (image, caption) VALUES (?, ?)");
            if ($stmt->execute([$filename, $caption])) {
                $message = "Image uploaded successfully!";
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
    <title>Upload Gallery Image</title>
</head>
<body>
<h2>Upload Gallery Image</h2>
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Caption (optional):</label><br>
    <input type="text" name="caption"><br><br>

    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Upload</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
