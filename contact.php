<?php
require __DIR__ . '/auth.php';
require_login();
$selectedPet = $_GET['pet'] ?? '';
$submitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact / Adopt</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Contact / Adoption Form</h1>
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
    <?php if ($submitted): ?>
        <section class="message">
            <h2>Thank you!</h2>
            <p>Your request has been submitted. We will contact you soon.</p>
        </section>
    <?php else: ?>
        <form method="post" class="contact-form">
            <label>
                Your Name
                <input type="text" name="name" required>
            </label>
            <label>
                Email
                <input type="email" name="email" required>
            </label>
            <label>
                Pet you are interested in
                <input type="text" name="pet" value="<?php echo htmlspecialchars($selectedPet); ?>" required>
            </label>
            <label>
                Message
                <textarea name="message" rows="4" required></textarea>
            </label>
            <button type="submit" class="button">Send</button>
        </form>
    <?php endif; ?>
</main>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Pet Adoption Center</p>
</footer>
</body>
</html>
