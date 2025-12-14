<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

$page_title = 'About';

include 'includes/header.php';
?>

<!-- About Hero Section -->
<section class="section" style="background: var(--gradient); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">About Me</h1>
                <p class="lead">Passionate developer with 5+ years of experience creating digital solutions that make a difference</p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="assets/images/about-hero.jpg" alt="About Me" class="img-fluid rounded-3 shadow-custom" style="max-width: 500px;">
            </div>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">My Story</h2>
                <p class="lead text-muted mb-5">
                    I'm a passionate full-stack developer with over 5 years of experience in creating 
                    modern, responsive websites and applications. My journey began with a curiosity 
                    about how websites work, and it has evolved into a career dedicated to helping 
                    businesses establish their online presence.
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="assets/images/about-detail.jpg" alt="Working" class="img-fluid rounded-3">
                </div>
            </div>
            <div class="col-lg-6">
                <h3 class="mb-4">Why Choose Me?</h3>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-code text-primary fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Clean Code</h5>
                                <p class="text-muted">I write maintainable, scalable code following best practices.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-mobile-alt text-primary fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Responsive Design</h5>
                                <p class="text-muted">All my projects are mobile-first and fully responsive.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-rocket text-primary fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>Fast Delivery</h5>
                                <p class="text-muted">I deliver projects on time without compromising quality.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-headset text-primary fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>24/7 Support</h5>
                                <p class="text-muted">I provide ongoing support and maintenance for all projects.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="section bg-light-gray">
    <div class="container">
        <h2 class="section-title">My Skills</h2>
        <p class="section-subtitle">Technologies and tools I work with</p>
        
        <div class="row">
            <div class="col-lg-6">
                <h4 class="mb-4">Frontend Development</h4>
                <div class="skill-item">
                    <div class="skill-name">HTML5 & CSS3</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="95"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <div class="skill-name">JavaScript & jQuery</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="90"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <div class="skill-name">React & Vue.js</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="85"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <div class="skill-name">Bootstrap & Tailwind</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="92"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <h4 class="mb-4">Backend Development</h4>
                <div class="skill-item">
                    <div class="skill-name">PHP & Laravel</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="88"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <div class="skill-name">Node.js & Express</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="80"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <div class="skill-name">MySQL & MongoDB</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="85"></div>
                    </div>
                </div>
                <div class="skill-item">
                    <div class="skill-name">RESTful APIs</div>
                    <div class="skill-level">
                        <div class="skill-progress" data-width="90"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-lg-12">
                <h4 class="mb-4">Tools & Technologies</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center">
                            <i class="fab fa-git-alt fa-3x text-primary mb-2"></i>
                            <h6>Git</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center">
                            <i class="fab fa-docker fa-3x text-primary mb-2"></i>
                            <h6>Docker</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center">
                            <i class="fab fa-aws fa-3x text-primary mb-2"></i>
                            <h6>AWS</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="text-center">
                            <i class="fas fa-database fa-3x text-primary mb-2"></i>
                            <h6>Database Design</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title">My Experience</h2>
        <p class="section-subtitle">Professional journey and achievements</p>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h5>Senior Full-Stack Developer</h5>
                            <h6 class="text-primary">TechCorp Inc. | 2022 - Present</h6>
                            <p class="text-muted">Leading development of enterprise web applications, mentoring junior developers, and implementing best practices for code quality and performance.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h5>Full-Stack Developer</h5>
                            <h6 class="text-primary">Digital Solutions Ltd. | 2020 - 2022</h6>
                            <p class="text-muted">Developed responsive websites and web applications for various clients, specializing in e-commerce solutions and custom CMS development.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h5>Frontend Developer</h5>
                            <h6 class="text-primary">WebStudio | 2019 - 2020</h6>
                            <p class="text-muted">Created modern, responsive user interfaces using HTML5, CSS3, JavaScript, and various frameworks. Collaborated with designers to implement pixel-perfect designs.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h5>Junior Web Developer</h5>
                            <h6 class="text-primary">StartupXYZ | 2018 - 2019</h6>
                            <p class="text-muted">Started my professional journey developing small business websites and learning modern web development practices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: var(--gradient); color: white;">
    <div class="container text-center">
        <h2 class="section-title text-white">Let's Work Together</h2>
        <p class="section-subtitle text-white-50">Ready to bring your ideas to life? Let's discuss your project!</p>
        <div class="mt-4">
            <a href="contact.php" class="btn btn-light btn-lg me-3">Get In Touch</a>
            <a href="assets/files/resume.pdf" class="btn btn-outline-light btn-lg" download>
                <i class="fas fa-download me-2"></i>Download Resume
            </a>
        </div>
    </div>
</section>

<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--primary-color);
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-left: 80px;
}

.timeline-marker {
    position: absolute;
    left: 20px;
    top: 5px;
    width: 20px;
    height: 20px;
    background: var(--primary-color);
    border-radius: 50%;
    border: 4px solid white;
    box-shadow: 0 0 0 4px var(--primary-color);
}

.timeline-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.timeline-content h5 {
    margin-bottom: 5px;
    color: var(--dark-color);
}

.timeline-content h6 {
    margin-bottom: 10px;
}
</style>

<?php include 'includes/footer.php'; ?>