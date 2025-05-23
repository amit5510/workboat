<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = $_FILES['image'];

    if ($image['error'] === 0) {
        $targetDir = "../assets/uploads/";
        $fileName = time() . "_" . basename($image["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                $sql = "INSERT INTO gallery (title, image_path) VALUES ('$title', '$fileName')";
                if (mysqli_query($conn, $sql)) {
                    $msg = "Image uploaded successfully!";
                } else {
                    $msg = "DB Error: " . mysqli_error($conn);
                }
            } else {
                $msg = "Failed to upload image.";
            }
        } else {
            $msg = "Only JPG, JPEG, PNG, GIF files allowed.";
        }
    } else {
        $msg = "Image upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Gallery - Admin</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
.container { margin-left: 200px; padding: 20px; }
form { max-width: 400px; background: #f9f9f9; padding: 20px; border-radius: 6px; }
label { display: block; margin-bottom: 8px; }
input[type="text"], input[type="file"] { width: 100%; margin-bottom: 10px; padding: 8px; }
input[type="submit"] { padding: 10px 15px; background: #2c3e50; color: white; border: none; cursor: pointer; }
.success { color: green; }
.error { color: red; }
</style>
</head>
<body>

<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="upload.php">Upload Gallery</a>
    <a href="careers.php">Manage Careers</a>
    <a href="contacts.php">View Contacts</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Upload Gallery Image</h2>

    <?php if ($msg): ?>
        <p class="<?= strpos($msg, 'success') !== false ? 'success' : 'error'; ?>"><?= $msg; ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label for="title">Image Title:</label>
        <input type="text" name="title" required>

        <label for="image">Select Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <input type="submit" value="Upload">
    </form>
</div>

</body>
</html>
