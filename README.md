# Pet Adoption Center (PHP)

A simple PHP web application for managing a small pet adoption center.

## Tech Stack
- PHP (no framework)
- JSON files for data persistence
- HTML/CSS frontend
- Runs under XAMPP/Apache (htdocs/adoption)

## Project Structure

```text
adoption/
  admin_pets.php       # Admin manage pets (CRUD)
  auth.php             # Authentication and session helpers
  contact.php          # Contact / adoption request form
  data.php             # Pet data helpers (JSON-backed)
  index.php            # Public home page
  login.php            # Login form and logic
  logout.php           # Logout logic
  pet.php              # Single pet details page
  pets.php             # User dashboard + pet list
  register.php         # Registration page
  styles.css           # Global styles (currently linked in header.php)
  logo.jpg.jpg         # Site logo

  includes/
    header.php         # Shared page header, navigation, opening <main>
    footer.php         # Shared footer and closing tags

  assets/              # For static front-end assets (prepared)
    .keep

  storage/             # For JSON data files (prepared)
    .keep

  database/            # For SQL schema / database dumps (prepared)
    .keep

  pets_data.json       # Pet data (currently used by data.php)
  users_data.json      # User data (currently used by auth.php)
  database.sql         # Database schema (optional, for future DB use)
```

> Note: Some files are still in the root for compatibility. The `assets/`, `storage/`, and `database/` folders are ready for a future refactor (moving CSS, images, JSON, and SQL into them).

## How to Run (XAMPP)

1. Copy this project folder into your XAMPP `htdocs` directory as `adoption`:
   - `c:/xampp/htdocs/adoption`
2. Start **Apache** in XAMPP.
3. Open your browser and visit:
   - `http://localhost/adoption/index.php`

## Default Accounts

The app uses a JSON file for users and automatically creates a default admin user if none exists:

- Username: `admin`
- Password: `admin123`

You can register new user accounts through the **Register** page.

## Next Improvements

- Move `styles.css` and images into `assets/` and update paths.
- Move `pets_data.json` and `users_data.json` into `storage/` and update `auth.php`/`data.php`.
- Replace JSON persistence with a real database using `database.sql`.
- Add validation and stronger password handling.
