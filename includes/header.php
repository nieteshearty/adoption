<?php
// Shared page header and navigation
// Assumes auth helper functions (is_logged_in, is_admin, current_user) may or may not be loaded

$is_logged_in = function_exists('is_logged_in') && is_logged_in();
$is_admin = function_exists('is_admin') && is_admin();
$current_user = ($is_logged_in && function_exists('current_user')) ? current_user() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Adoption Center</title>
    <link rel="stylesheet" href="/adoption/styles.css">
</head>
<body>
<header>
    <div class="header-brand">
        <img src="/adoption/logo.jpg.jpg" alt="Pet Adoption Center Logo" class="header-logo-img">
        <h1>Pet Adoption Center</h1>
    </div>
    <nav>
        <a href="#" class="nav-ads-button">Ads</a>
        <a href="/adoption/index.php">Home</a>
        <a href="/adoption/pets.php">Available Pets</a>
        <a href="/adoption/contact.php">Contact</a>
        <?php if ($is_admin): ?>
            <a href="/adoption/admin_pets.php">Admin</a>
        <?php endif; ?>
        <?php if ($is_logged_in): ?>
            <a href="/adoption/logout.php">Logout (<?php echo htmlspecialchars($current_user['username'] ?? ''); ?>)</a>
        <?php else: ?>
            <a href="/adoption/login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>
<main>
