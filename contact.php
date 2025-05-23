<?php include 'includes/header.php'; ?>
<?php
include 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['message']);

    if ($name && $email && $subject && $msg) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $email, $subject, $msg);
        if ($stmt->execute()) {
            $message = "Thank you for contacting us. We will get back to you soon.";
        } else {
            $message = "Error submitting form. Please try again.";
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
<title>Contact Us - Workboat Media</title>
<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
  <h1>Contact Us</h1>

  <?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" action="">
    <label>Name:</label><br />
    <input type="text" name="name" required /><br /><br />

    <label>Email:</label><br />
    <input type="email" name="email" required /><br /><br />

    <label>Subject:</label><br />
    <input type="text" name="subject" required /><br /><br />

    <label>Message:</label><br />
    <textarea name="message" rows="6" required></textarea><br /><br />

    <button type="submit">Send Message</button>
  </form>
</body>
</html>

<?php include 'includes/footer.php'; ?>
