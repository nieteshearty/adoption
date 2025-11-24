<?php
require __DIR__ . '/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $USERS = load_users();
    if (isset($USERS[$username]) && $USERS[$username]['password'] === $password) {
        $_SESSION['user'] = [
            'username' => $username,
            'role' => $USERS[$username]['role'],
        ];

        if ($USERS[$username]['role'] === 'admin') {
            header('Location: admin_pets.php');
        } else {
            header('Location: pets.php');
        }
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Login</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="pets.php">Available Pets</a>
        <a href="contact.php">Contact</a>
    </nav>
</header>
<main>
    <?php if ($error): ?>
        <section class="message error">
            <p><?php echo htmlspecialchars($error); ?></p>
        </section>
    <?php endif; ?>
    <form method="post" class="contact-form">
        <label>
            Username
            <input type="text" name="username" required>
        </label>
        <label>
            Password
            <input type="password" name="password" required>
        </label>
        <button type="submit" class="button">Login</button>
    </form>
    <section class="message">
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Pet Adoption Center</p>
</footer>
</body>
</html>
