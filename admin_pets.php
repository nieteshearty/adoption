<?php
require __DIR__ . '/auth.php';
require_admin();
require __DIR__ . '/data.php';

$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_pet'])) {
        $name = trim($_POST['name'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $age = (int)($_POST['age'] ?? 0);
        $description = trim($_POST['description'] ?? '');

        $pets = load_pets();

        if ($action === 'edit' && $id !== null) {
            foreach ($pets as &$pet) {
                if ((int)$pet['id'] === $id) {
                    $pet['name'] = $name;
                    $pet['type'] = $type;
                    $pet['age'] = $age;
                    $pet['description'] = $description;
                    break;
                }
            }
            unset($pet);
        } else {
            $maxId = 0;
            foreach ($pets as $p) {
                if ((int)$p['id'] > $maxId) {
                    $maxId = (int)$p['id'];
                }
            }
            $pets[] = [
                'id' => $maxId + 1,
                'name' => $name,
                'type' => $type,
                'age' => $age,
                'description' => $description,
            ];
        }

        save_pets($pets);
        header('Location: admin_pets.php');
        exit;
    }
}

if ($action === 'delete' && $id !== null) {
    $pets = load_pets();
    $pets = array_values(array_filter($pets, function ($pet) use ($id) {
        return (int)$pet['id'] !== $id;
    }));
    save_pets($pets);
    header('Location: admin_pets.php');
    exit;
}

$pets = load_pets();
$editingPet = null;
if ($action === 'edit' && $id !== null) {
    foreach ($pets as $p) {
        if ((int)$p['id'] === $id) {
            $editingPet = $p;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Pets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Admin - Manage Pets</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="pets.php">Available Pets</a>
        <a href="contact.php">Contact</a>
        <a href="admin_pets.php">Admin</a>
        <a href="logout.php">Logout (<?php echo htmlspecialchars(current_user()['username'] ?? ''); ?>)</a>
    </nav>
</header>
<main>
    <section class="pet-list">
        <h2>Existing Pets</h2>
        <?php foreach ($pets as $pet): ?>
            <article class="pet-card">
                <h3><?php echo htmlspecialchars($pet['name']); ?></h3>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                <p><?php echo htmlspecialchars($pet['description']); ?></p>
                <a class="button" href="admin_pets.php?action=edit&id=<?php echo urlencode($pet['id']); ?>">Edit</a>
                <a class="button" href="admin_pets.php?action=delete&id=<?php echo urlencode($pet['id']); ?>" onclick="return confirm('Delete this pet?');">Delete</a>
            </article>
        <?php endforeach; ?>
    </section>

    <section class="pet-detail">
        <h2><?php echo $editingPet ? 'Edit Pet' : 'Add New Pet'; ?></h2>
        <form method="post" class="contact-form">
            <label>
                Name
                <input type="text" name="name" value="<?php echo htmlspecialchars($editingPet['name'] ?? ''); ?>" required>
            </label>
            <label>
                Type
                <input type="text" name="type" value="<?php echo htmlspecialchars($editingPet['type'] ?? ''); ?>" required>
            </label>
            <label>
                Age (years)
                <input type="number" name="age" min="0" value="<?php echo htmlspecialchars($editingPet['age'] ?? ''); ?>" required>
            </label>
            <label>
                Description
                <textarea name="description" rows="3" required><?php echo htmlspecialchars($editingPet['description'] ?? ''); ?></textarea>
            </label>
            <button type="submit" name="save_pet" class="button">Save</button>
        </form>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date('Y'); ?> Pet Adoption Center</p>
</footer>
</body>
</html>
