<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Workboat Media</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
<div class="admin-wrapper">
  <aside class="sidebar">
    <h2>Admin</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="upload.php">Upload Gallery</a>
      <a href="gallery_manage.php">Manage Gallery</a>
      <a href="careers_manage.php">Careers</a>
      <a href="contacts.php">Contacts</a>
    </nav>
  </aside>

  <div class="main-content">
    <header class="top-bar">
      <span>Welcome, <?= htmlspecialchars($_SESSION['admin']) ?></span>
      <a href="logout.php" class="logout-btn">Logout</a>
    </header>
    <main class="dashboard-content">
