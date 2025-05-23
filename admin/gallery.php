<?php
require_once 'includes/db.php';

// Handle delete request first
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Get filename from DB to unlink
    $res = $conn->query("SELECT image_path FROM gallery WHERE id=$id");
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $filePath = "assets/uploads/" . $row['image_path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $conn->query("DELETE FROM gallery WHERE id=$id");
    }
    header("Location: gallery.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="gallery-container">
    <h2>Our Work Gallery</h2>
    <div class="gallery-grid">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM gallery ORDER BY uploaded_at DESC");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $imagePath = 'assets/uploads/' . htmlspecialchars($row['image_path']);
                $title = htmlspecialchars($row['title']);
                $id = intval($row['id']);
                echo "<div class='gallery-item'>
                        <img src='$imagePath' alt='$title'>
                        <h4>$title</h4>
                        <a href='gallery.php?delete=$id' onclick='return confirm(\"Are you sure you want to delete this image?\");'>Delete</a>
                      </div>";
            }
        } else {
            echo "<p>No images found.</p>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
