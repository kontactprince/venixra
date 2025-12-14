<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

$page_title = 'Services';
$services = getServices();

include 'includes/header.php';
?>

<!-- Services Hero Section -->
<section class="section" style="background: var(--gradient); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">My Services</h1>
                <p class="lead">Comprehensive web development and design solutions tailored to your business needs</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="section">
    <div class="container">
        <div class="row">
            <?php foreach($services as $service): ?>
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
                    </div>
                    <h3 class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p class="text-muted mb-4"><?php echo htmlspecialchars($service['description']); ?></p>
                    <div class="service-price mb-4"><?php echo htmlspecialchars($service['price_range']); ?></div>
                    <a href="contact.php" class="btn btn-outline-primary">Get Quote</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="section bg-light-gray">
    <div class="container">
        <h2 class="section-title">My Process</h2>
        <p class="section-subtitle">How I work with clients to deliver exceptional results</p>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <i class="fas fa-comments fa-3x text-primary mb-3"></i>
                        <h5>Discovery</h5>
                        <p class="text-muted">We discuss your project requirements, goals, and vision to understand what you need.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <i class="fas fa-pencil-ruler fa-3x text-primary mb-3"></i>
                        <h5>Planning</h5>
                        <p class="text-muted">I create a detailed project plan with timelines, milestones, and deliverables.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <i class="fas fa-code fa-3x text-primary mb-3"></i>
                        <h5>Development</h5>
                        <p class="text-muted">I build your project using the latest technologies and best practices.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center">
                    <div class="process-step">
                        <div class="step-number">4</div>
                        <i class="fas fa-rocket fa-3x text-primary mb-3"></i>
                        <h5>Launch</h5>
                        <p class="text-muted">I deploy your project and provide ongoing support and maintenance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Me Section -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title text-start">Why Choose Me?</h2>
                <p class="lead text-muted mb-4">
                    With over 5 years of experience in web development, I bring expertise, 
                    reliability, and creativity to every project.
                </p>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>5+ Years Experience</h6>
                                <p class="text-muted small">Proven track record of successful projects</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>100+ Projects</h6>
                                <p class="text-muted small">Diverse portfolio across industries</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>24/7 Support</h6>
                                <p class="text-muted small">Always available for your needs</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Money Back Guarantee</h6>
                                <p class="text-muted small">100% satisfaction guaranteed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="assets/images/services-detail.jpg" alt="Why Choose Me" class="img-fluid rounded-3 shadow-custom">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="section bg-light-gray">
    <div class="container">
        <h2 class="section-title">Pricing Plans</h2>
        <p class="section-subtitle">Flexible pricing options to fit your budget</p>
        
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h4>Basic</h4>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">500</span>
                            <span class="period">/project</span>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Up to 5 pages</li>
                            <li><i class="fas fa-check text-success me-2"></i>Responsive design</li>
                            <li><i class="fas fa-check text-success me-2"></i>Contact form</li>
                            <li><i class="fas fa-check text-success me-2"></i>Basic SEO</li>
                            <li><i class="fas fa-check text-success me-2"></i>1 month support</li>
                        </ul>
                        <a href="contact.php" class="btn btn-outline-primary w-100">Get Started</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card featured">
                    <div class="pricing-badge">Most Popular</div>
                    <div class="pricing-header">
                        <h4>Professional</h4>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">1500</span>
                            <span class="period">/project</span>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Up to 15 pages</li>
                            <li><i class="fas fa-check text-success me-2"></i>Custom design</li>
                            <li><i class="fas fa-check text-success me-2"></i>CMS integration</li>
                            <li><i class="fas fa-check text-success me-2"></i>Advanced SEO</li>
                            <li><i class="fas fa-check text-success me-2"></i>3 months support</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary w-100">Get Started</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h4>Enterprise</h4>
                        <div class="price">
                            <span class="currency">$</span>
                            <span class="amount">5000</span>
                            <span class="period">/project</span>
                        </div>
                    </div>
                    <div class="pricing-body">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Unlimited pages</li>
                            <li><i class="fas fa-check text-success me-2"></i>Custom functionality</li>
                            <li><i class="fas fa-check text-success me-2"></i>E-commerce features</li>
                            <li><i class="fas fa-check text-success me-2"></i>Full SEO package</li>
                            <li><i class="fas fa-check text-success me-2"></i>6 months support</li>
                        </ul>
                        <a href="contact.php" class="btn btn-outline-primary w-100">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: var(--gradient); color: white;">
    <div class="container text-center">
        <h2 class="section-title text-white">Ready to Get Started?</h2>
        <p class="section-subtitle text-white-50">Let's discuss your project and bring your vision to life</p>
        <div class="mt-4">
            <a href="contact.php" class="btn btn-light btn-lg me-3">Start Your Project</a>
            <a href="portfolio.php" class="btn btn-outline-light btn-lg">View My Work</a>
        </div>
    </div>
</section>

<style>
.process-step {
    position: relative;
    padding: 20px;
}

.step-number {
    position: absolute;
    top: -10px;
    right: -10px;
    background: var(--primary-color);
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.pricing-card {
    background: white;
    border-radius: 15px;
    padding: 0;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.pricing-card.featured {
    border: 2px solid var(--primary-color);
    transform: scale(1.05);
}

.pricing-badge {
    position: absolute;
    top: 20px;
    right: -30px;
    background: var(--primary-color);
    color: white;
    padding: 5px 40px;
    font-size: 12px;
    font-weight: bold;
    transform: rotate(45deg);
}

.pricing-header {
    background: var(--gradient);
    color: white;
    padding: 30px 20px;
    text-align: center;
}

.pricing-header h4 {
    margin-bottom: 10px;
    font-size: 1.5rem;
}

.price {
    font-size: 2.5rem;
    font-weight: bold;
}

.currency {
    font-size: 1.5rem;
    vertical-align: top;
}

.period {
    font-size: 1rem;
    font-weight: normal;
}

.pricing-body {
    padding: 30px 20px;
}

.pricing-body ul li {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.pricing-body ul li:last-child {
    border-bottom: none;
}
</style>

<?php include 'includes/footer.php'; ?>