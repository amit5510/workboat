<?php
require_once 'includes/db.php';

// Fetch about info (assuming one row)
$aboutRes = $conn->query("SELECT * FROM about LIMIT 1");
$about = $aboutRes ? $aboutRes->fetch_assoc() : null;

// Fetch projects
$projectsRes = $conn->query("SELECT * FROM projects");

// Fetch services
$servicesRes = $conn->query("SELECT * FROM services");
?>

<?php include 'includes/header.php'; ?>

<main>
  <h2>Welcome to <?= htmlspecialchars($about['company_name'] ?? 'Workboat Media Pvt Ltd') ?></h2>

  <p>We are a leading media company specializing in digital marketing, web development, and creative solutions tailored to your business needs.</p>

  <section id="about">
    <h3>About Us</h3>
    <p><?= nl2br(htmlspecialchars($about['description'] ?? 'Founded in 2014, Workboat Media Pvt. Ltd. has been delivering exceptional digital services across various industries. Our mission is to empower businesses with innovative technologies and creative strategies.')) ?></p>
  </section>

  <section id="projects">
    <h3>Our Projects</h3>
    <ul>
      <?php if ($projectsRes && $projectsRes->num_rows > 0): ?>
        <?php while ($project = $projectsRes->fetch_assoc()): ?>
          <li><strong><?= htmlspecialchars($project['name']) ?>:</strong> <?= htmlspecialchars($project['description']) ?></li>
        <?php endwhile; ?>
      <?php else: ?>
        <li>No projects found.</li>
      <?php endif; ?>
    </ul>
  </section>

  <section id="services">
    <h3>Our Services</h3>
    <ul>
      <?php if ($servicesRes && $servicesRes->num_rows > 0): ?>
        <?php while ($service = $servicesRes->fetch_assoc()): ?>
          <li><?= htmlspecialchars($service['title']) ?><?= !empty($service['description']) ? ': ' . htmlspecialchars($service['description']) : '' ?></li>
        <?php endwhile; ?>
      <?php else: ?>
        <li>No services listed.</li>
      <?php endif; ?>
    </ul>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
