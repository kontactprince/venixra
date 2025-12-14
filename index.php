<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

$page_title = 'Home';
$services = getServices();
$featured_portfolio = getFeaturedPortfolio();
$testimonials = getTestimonials();

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">Hi, I'm <span class="text-gradient">PRINCE KUMAR</span></h1>
                    <p class="hero-subtitle">I build modern websites and applications that help businesses grow online</p>
                    <div class="hero-buttons">
                        <a href="contact.php" class="btn btn-primary me-3">Hire Me</a>
                        <a href="portfolio.php" class="btn btn-outline-light">View My Work</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="assets/images/hero-image.jpg" alt="PRINCE KUMAR" class="img-fluid rounded-circle shadow-custom" style="max-width: 400px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section bg-light-gray">
    <div class="container">
        <h2 class="section-title">My Services</h2>
        <p class="section-subtitle">I offer a wide range of web development and design services to help your business succeed</p>
        
        <div class="row">
            <?php foreach($services as $service): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
                    </div>
                    <h3 class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p class="text-muted"><?php echo htmlspecialchars($service['description']); ?></p>
                    <div class="service-price"><?php echo htmlspecialchars($service['price_range']); ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="services.php" class="btn btn-primary">View All Services</a>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Featured Work</h2>
        <p class="section-subtitle">Take a look at some of my recent projects</p>
        
        <div class="row">
            <?php foreach($featured_portfolio as $project): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="portfolio-item">
                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="portfolio-image">
                    <div class="portfolio-overlay">
                        <?php if($project['project_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['project_url']); ?>" target="_blank" class="btn btn-light me-2">
                            <i class="fas fa-external-link-alt me-1"></i> Live Demo
                        </a>
                        <?php endif; ?>
                        <?php if($project['github_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['github_url']); ?>" target="_blank" class="btn btn-outline-light">
                            <i class="fab fa-github me-1"></i> Code
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-3">
                    <h5><?php echo htmlspecialchars($project['title']); ?></h5>
                    <p class="text-muted"><?php echo htmlspecialchars($project['description']); ?></p>
                    <div class="d-flex flex-wrap gap-2">
                        <?php 
                        $technologies = explode(',', $project['technologies']);
                        foreach($technologies as $tech): 
                        ?>
                        <span class="badge bg-primary"><?php echo trim($tech); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="portfolio.php" class="btn btn-primary">View All Projects</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section bg-light-gray">
    <div class="container">
        <h2 class="section-title">What Clients Say</h2>
        <p class="section-subtitle">Don't just take my word for it - hear from my satisfied clients</p>
        
        <div class="row">
            <?php foreach($testimonials as $testimonial): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <p class="testimonial-text"><?php echo htmlspecialchars($testimonial['testimonial']); ?></p>
                    <div class="testimonial-author"><?php echo htmlspecialchars($testimonial['client_name']); ?></div>
                    <div class="testimonial-position">
                        <?php echo htmlspecialchars($testimonial['client_position']); ?>
                        <?php if($testimonial['client_company']): ?>
                        at <?php echo htmlspecialchars($testimonial['client_company']); ?>
                        <?php endif; ?>
                    </div>
                    <div class="mt-2">
                        <?php for($i = 1; $i <= $testimonial['rating']; $i++): ?>
                        <i class="fas fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: var(--gradient); color: white;">
    <div class="container text-center">
        <h2 class="section-title text-white">Ready to Start Your Project?</h2>
        <p class="section-subtitle text-white-50">Let's work together to bring your ideas to life</p>
        <div class="mt-4">
            <a href="contact.php" class="btn btn-light btn-lg me-3">Get In Touch</a>
            <a href="portfolio.php" class="btn btn-outline-light btn-lg">View Portfolio</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>