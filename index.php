<?php require __DIR__ . '/auth.php'; ?>
<?php require __DIR__ . '/data.php'; ?>
<?php
if (is_logged_in() && !is_admin()) {
    header('Location: pets.php');
    exit;
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
    <section class="hero hero-split">
        <div class="hero-text">
            <h2>Adopt A Pet, Change A Life</h2>
            <p>We connect loving families with rescued cats and dogs. Give them a second chance and find your new best friend today.</p>
            <div class="hero-actions">
                <a class="button primary" href="pets.php">View Available Pets</a>
                <a class="button secondary" href="contact.php">Contact Our Team</a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">150+</span>
                    <span class="stat-label">Pets Adopted</span>
                </div>
                <div class="stat">
                    <span class="stat-number">25</span>
                    <span class="stat-label">Active Volunteers</span>
                </div>
                <div class="stat">
                    <span class="stat-number">5+</span>
                    <span class="stat-label">Years Caring</span>
                </div>
            </div>
        </div>
        <div class="hero-logo">
            <img src="logo.jpg.jpg" alt="Pet Adoption Center Logo">
        </div>
    </section>

    <section class="section features">
        <h3 class="section-title">Why Adopt With Us</h3>
        <div class="feature-grid">
            <article class="feature-card">
                <h4>Health Checked Pets</h4>
                <p>All our animals receive full veterinary checks, vaccinations, and are spayed or neutered before adoption.</p>
            </article>
            <article class="feature-card">
                <h4>Careful Matching</h4>
                <p>We take time to understand your lifestyle to match you with the pet that fits your home and family.</p>
            </article>
            <article class="feature-card">
                <h4>Ongoing Support</h4>
                <p>Our team is here to guide you before, during, and after adoption with training and care tips.</p>
            </article>
        </div>
    </section>

    <section class="section section-alt about">
        <div class="about-content">
            <div>
                <h3 class="section-title">About Our Shelter</h3>
                <p>We are a non-profit pet adoption center dedicated to rescuing, rehabilitating, and rehoming animals in need. Every pet in our care has a unique story, and we work tirelessly to ensure each one finds a safe and loving forever home.</p>
                <p>From playful puppies to gentle senior cats, we provide individualized care, enrichment, and socialization to help them thrive.</p>
            </div>
            <ul class="about-list">
                <li>Safe, clean, and comfortable environment for all animals.</li>
                <li>Professional veterinary partners and behavior specialists.</li>
                <li>Transparent adoption process with clear guidance.</li>
            </ul>
        </div>
    </section>

    <section class="section services">
        <h3 class="section-title">What We Offer</h3>
        <div class="service-grid">
            <article class="service-card">
                <h4>Pet Adoption</h4>
                <p>Meet carefully evaluated pets ready to join your family. Our team guides you from first visit to final adoption.</p>
            </article>
            <article class="service-card">
                <h4>Foster Program</h4>
                <p>Open your home temporarily to pets waiting for adoption. Fostering helps us rescue more animals in need.</p>
            </article>
            <article class="service-card">
                <h4>Education & Training</h4>
                <p>Workshops and one-on-one sessions to help you understand behavior, training, and long-term pet care.</p>
            </article>
        </div>
    </section>

    <section class="section section-alt featured">
        <div class="featured-header">
            <h3 class="section-title">Featured Pets</h3>
            <p>Here are a few of our many wonderful animals currently looking for homes.</p>
        </div>
        <div class="featured-grid">
            <?php foreach (array_slice($pets, 0, 3) as $pet): ?>
                <article class="pet-card">
                    <h4><?php echo htmlspecialchars($pet['name']); ?></h4>
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($pet['type']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($pet['age']); ?> years</p>
                    <p><?php echo htmlspecialchars($pet['description']); ?></p>
                    <a class="button secondary" href="pet.php?id=<?php echo urlencode($pet['id']); ?>">View Details</a>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="section-cta">
            <a class="button primary" href="pets.php">See All Pets</a>
        </div>
    </section>

    <section class="section cta-block">
        <div class="cta-inner">
            <div>
                <h3 class="section-title">Ready To Meet Your New Best Friend?</h3>
                <p>Start your adoption journey today. Create an account, browse our pets, and submit your adoption request in just a few clicks.</p>
            </div>
            <div class="cta-actions">
                <a class="button primary" href="login.php">Login</a>
                <a class="button secondary" href="register.php">Create Account</a>
            </div>
        </div>
    </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
