<?php require __DIR__ . '/auth.php'; ?>
<?php require_login(); ?>
<?php require __DIR__ . '/data.php'; ?>
<?php
$id = $_GET['id'] ?? null;
$pet = null;
foreach ($pets as $p) {
    if ((string)$p['id'] === (string)$id) {
        $pet = $p;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pet ? htmlspecialchars($pet['name']) . ' - Pet Details' : 'Pet Not Found'; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Pet Details</h1>
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
    <?php if ($pet): ?>
        <article class="pet-detail">
            <h2><?php echo htmlspecialchars($pet['name']); ?></h2>
            <p><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
            <p><?php echo htmlspecialchars($pet['description']); ?></p>
            <a class="button" href="contact.php?pet=<?php echo urlencode($pet['name']); ?>">Adopt this pet</a>
        </article>
    <?php else: ?>
        <p>Pet not found. Go back to the <a href="pets.php">list of pets</a>.</p>
    <?php endif; ?>
</main>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Pet Adoption Center</p>
</footer>
</body>
</html>
