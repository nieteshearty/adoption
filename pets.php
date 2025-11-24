<?php require __DIR__ . '/auth.php'; ?>
<?php require_login(); ?>
<?php require __DIR__ . '/data.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Adoption Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Adoption Dashboard</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="pets.php">Available Pets</a>
        <a href="contact.php">Contact</a>
        <?php if (is_admin()): ?>
            <a href="admin_pets.php">Admin</a>
        <?php endif; ?>
        <?php if (is_logged_in()): ?>
            <a href="logout.php">Logout (<?php echo htmlspecialchars(current_user()['username'] ?? ''); ?>)</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <?php $user = current_user(); ?>
    <section class="section section-alt">
        <h2 class="section-title">Welcome, <?php echo htmlspecialchars($user['username'] ?? ''); ?>!</h2>
        <p>Here you can explore all of our pets currently available for adoption and view more details about each one.</p>
        <div class="hero-stats">
            <div class="stat">
                <span class="stat-number"><?php echo count($pets); ?></span>
                <span class="stat-label">Pets Available</span>
            </div>
            <div class="stat">
                <span class="stat-number">1</span>
                <span class="stat-label">Account</span>
            </div>
        </div>
    </section>

    <section class="section dashboard-actions">
        <div class="dashboard-grid">
            <article class="dashboard-card">
                <h3>Browse All Pets</h3>
                <p>See every pet currently available for adoption and find the one that fits your home.</p>
                <a class="button primary" href="pets.php">View All Pets</a>
            </article>
            <article class="dashboard-card">
                <h3>Your Adoption Request</h3>
                <p>Found a pet you love? Use the contact form to send us your adoption request.</p>
                <a class="button secondary" href="contact.php">Go To Contact Form</a>
            </article>
            <article class="dashboard-card">
                <h3>Update Your Details</h3>
                <p>Make sure we can reach you quickly by keeping your contact information up to date.</p>
                <span class="dashboard-note">Profile management coming soon</span>
            </article>
        </div>
    </section>

    <section class="section">
        <h3 class="section-title">Available Pets</h3>
        <div class="pet-list">
            <?php foreach ($pets as $pet): ?>
                <article class="pet-card">
                    <h2><?php echo htmlspecialchars($pet['name']); ?></h2>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                    <p><?php echo htmlspecialchars($pet['description']); ?></p>
                    <a class="button" href="pet.php?id=<?php echo urlencode($pet['id']); ?>">View details</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Pet Adoption Center</p>
</footer>
</body>
</html>
