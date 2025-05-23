<?php
// careers.php - Display career listings

include 'includes/db.php';  // your DB connection

$sql = "SELECT * FROM careers ORDER BY posted_at DESC";
$result = $conn->query($sql);
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Careers - Workboat Media</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <section class="careers-list">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <article class="job-opening">
          <h2><?= htmlspecialchars($row['title']) ?></h2>
          <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
          <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
          <small>Posted on <?= date('d M Y', strtotime($row['posted_at'])) ?></small>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No current job openings. Please check back later.</p>
    <?php endif; ?>
  </section>
</body>
</html>
<?php include 'includes/footer.php'; ?>