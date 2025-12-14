<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

$page_title = 'Portfolio';
$portfolio_projects = getAllPortfolio();

// Get unique categories for filter
$categories = array_unique(array_column($portfolio_projects, 'category'));

include 'includes/header.php';
?>

<!-- Portfolio Hero Section -->
<section class="section" style="background: var(--gradient); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">My Portfolio</h1>
                <p class="lead">A showcase of my recent projects and creative work</p>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Filter -->
<section class="section bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="portfolio-filter">
                    <button class="btn btn-outline-primary me-2 mb-2 active" data-filter="all">All Projects</button>
                    <?php foreach($categories as $category): ?>
                    <button class="btn btn-outline-primary me-2 mb-2" data-filter="<?php echo strtolower(str_replace(' ', '-', $category)); ?>">
                        <?php echo htmlspecialchars($category); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="section">
    <div class="container">
        <div class="row">
            <?php foreach($portfolio_projects as $project): ?>
            <div class="col-lg-4 col-md-6 mb-5 portfolio-item <?php echo strtolower(str_replace(' ', '-', $project['category'])); ?>">
                <div class="portfolio-card">
                    <div class="portfolio-image-container">
                        <img src="<?php echo htmlspecialchars($project['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($project['title']); ?>" 
                             class="portfolio-image">
                        <div class="portfolio-overlay">
                            <div class="portfolio-actions">
                                <?php if($project['project_url']): ?>
                                <a href="<?php echo htmlspecialchars($project['project_url']); ?>" 
                                   target="_blank" 
                                   class="btn btn-light me-2" 
                                   data-bs-toggle="tooltip" 
                                   title="View Live Demo">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <?php endif; ?>
                                <?php if($project['github_url']): ?>
                                <a href="<?php echo htmlspecialchars($project['github_url']); ?>" 
                                   target="_blank" 
                                   class="btn btn-outline-light" 
                                   data-bs-toggle="tooltip" 
                                   title="View Source Code">
                                    <i class="fab fa-github"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <div class="portfolio-category"><?php echo htmlspecialchars($project['category']); ?></div>
                        <h5 class="portfolio-title"><?php echo htmlspecialchars($project['title']); ?></h5>
                        <p class="portfolio-description"><?php echo htmlspecialchars($project['description']); ?></p>
                        <div class="portfolio-technologies">
                            <?php 
                            $technologies = explode(',', $project['technologies']);
                            foreach($technologies as $tech): 
                            ?>
                            <span class="badge bg-primary me-1 mb-1"><?php echo trim($tech); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section bg-light-gray">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-project-diagram fa-3x text-primary mb-3"></i>
                    <h3 class="stat-number">100+</h3>
                    <p class="stat-label">Projects Completed</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h3 class="stat-number">50+</h3>
                    <p class="stat-label">Happy Clients</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h3 class="stat-number">5+</h3>
                    <p class="stat-label">Years Experience</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-item">
                    <i class="fas fa-award fa-3x text-primary mb-3"></i>
                    <h3 class="stat-number">100%</h3>
                    <p class="stat-label">Client Satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">What Clients Say</h2>
        <p class="section-subtitle">Feedback from some of my recent projects</p>
        
        <div class="row">
            <?php 
            $testimonials = getTestimonials();
            foreach($testimonials as $testimonial): 
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="testimonial-card">
                    <div class="testimonial-rating mb-3">
                        <?php for($i = 1; $i <= $testimonial['rating']; $i++): ?>
                        <i class="fas fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="testimonial-text">"<?php echo htmlspecialchars($testimonial['testimonial']); ?>"</p>
                    <div class="testimonial-author">
                        <strong><?php echo htmlspecialchars($testimonial['client_name']); ?></strong>
                        <br>
                        <small class="text-muted">
                            <?php echo htmlspecialchars($testimonial['client_position']); ?>
                            <?php if($testimonial['client_company']): ?>
                            at <?php echo htmlspecialchars($testimonial['client_company']); ?>
                            <?php endif; ?>
                        </small>
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
        <h2 class="section-title text-white">Like What You See?</h2>
        <p class="section-subtitle text-white-50">Let's work together on your next project</p>
        <div class="mt-4">
            <a href="contact.php" class="btn btn-light btn-lg me-3">Start Your Project</a>
            <a href="services.php" class="btn btn-outline-light btn-lg">View Services</a>
        </div>
    </div>
</section>

<style>
.portfolio-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.portfolio-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.portfolio-image-container {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.portfolio-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.portfolio-card:hover .portfolio-image {
    transform: scale(1.1);
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 123, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.portfolio-card:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-actions {
    display: flex;
    gap: 10px;
}

.portfolio-content {
    padding: 20px;
}

.portfolio-category {
    color: var(--primary-color);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.portfolio-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: var(--dark-color);
}

.portfolio-description {
    color: var(--secondary-color);
    margin-bottom: 15px;
    line-height: 1.6;
}

.portfolio-technologies {
    margin-top: 15px;
}

.stat-item {
    padding: 20px;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--primary-color);
    margin-bottom: 10px;
}

.stat-label {
    color: var(--secondary-color);
    font-weight: 500;
    margin: 0;
}

.testimonial-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    height: 100%;
    position: relative;
}

.testimonial-card::before {
    content: '"';
    font-size: 4rem;
    color: var(--primary-color);
    position: absolute;
    top: 10px;
    left: 20px;
    font-family: serif;
    opacity: 0.3;
}

.testimonial-rating {
    margin-bottom: 20px;
}

.testimonial-text {
    font-style: italic;
    margin-bottom: 20px;
    color: var(--secondary-color);
    line-height: 1.6;
}

.testimonial-author {
    margin-top: 20px;
}

/* Filter Animation */
.portfolio-item {
    transition: all 0.3s ease;
}

.portfolio-item.hidden {
    display: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .portfolio-image-container {
        height: 200px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>