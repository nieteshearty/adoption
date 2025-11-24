<?php
require __DIR__ . '/auth.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirm_password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Username and password are required.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $users = load_users();
        if (isset($users[$username])) {
            $error = 'Username is already taken.';
        } else {
            $users[$username] = [
                'password' => $password,
                'role' => 'user',
            ];
            save_users($users);
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Register</h1>
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
    <?php if ($error): ?>
        <section class="message error">
            <p><?php echo htmlspecialchars($error); ?></p>
        </section>
    <?php endif; ?>
    <?php if ($success): ?>
        <section class="message">
            <h2>Registration successful!</h2>
            <p>You can now <a href="login.php">log in</a> with your new account.</p>
        </section>
    <?php else: ?>
        <form method="post" class="contact-form">
            <label>
                Username
                <input type="text" name="username" required>
            </label>
            <label>
                Password
                <input type="password" name="password" required>
            </label>
            <label>
                Confirm Password
                <input type="password" name="confirm_password" required>
            </label>
            <button type="submit" class="button">Register</button>
        </form>
    <?php endif; ?>
</main>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Pet Adoption Center</p>
</footer>
</body>
</html>
