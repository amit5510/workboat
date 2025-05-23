<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../includes/db.php';

// Delete contact message
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contacts WHERE id = $id");
    header('Location: view_contacts.php');
    exit;
}

$result = $conn->query("SELECT * FROM contacts ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin - View Contacts</title>
<link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
<div class="container">
<h2>Contact Messages</h2>

<?php if ($result->num_rows > 0): ?>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Submitted At</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
            <td><?= date('d M Y H:i', strtotime($row['submitted_at'])) ?></td>
            <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this message?')">Delete</a></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
<p>No messages found.</p>
<?php endif; ?>

<p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>