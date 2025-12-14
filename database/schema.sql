-- Personal Freelancing Website Database Schema
CREATE DATABASE IF NOT EXISTS freelancing_website;
USE freelancing_website;

-- Admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Services table
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price_range VARCHAR(50) NOT NULL,
    icon VARCHAR(50) DEFAULT 'fas fa-code',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Portfolio projects table
CREATE TABLE portfolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    project_url VARCHAR(255),
    github_url VARCHAR(255),
    technologies VARCHAR(255) NOT NULL,
    category VARCHAR(50) DEFAULT 'Web Development',
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Testimonials table
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(100) NOT NULL,
    client_position VARCHAR(100),
    client_company VARCHAR(100),
    testimonial TEXT NOT NULL,
    client_image VARCHAR(255),
    rating INT DEFAULT 5,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact messages table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO admin_users (username, email, password) VALUES 
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert sample services
INSERT INTO services (title, description, price_range, icon) VALUES 
('Web Development', 'Custom websites and web applications built with modern technologies', '$500 - $5000', 'fas fa-code'),
('UI/UX Design', 'Beautiful and intuitive user interfaces that enhance user experience', '$300 - $2000', 'fas fa-paint-brush'),
('SEO Optimization', 'Improve your website visibility and ranking on search engines', '$200 - $1000', 'fas fa-search'),
('Mobile App Development', 'Native and cross-platform mobile applications', '$1000 - $10000', 'fas fa-mobile-alt'),
('E-commerce Solutions', 'Complete online store setup with payment integration', '$800 - $5000', 'fas fa-shopping-cart');

-- Insert sample portfolio projects
INSERT INTO portfolio (title, description, image_url, project_url, github_url, technologies, category, is_featured) VALUES 
('E-commerce Website', 'Modern e-commerce platform with payment integration and admin panel', 'assets/images/portfolio/project1.jpg', 'https://example.com', 'https://github.com/example', 'PHP, MySQL, Bootstrap, JavaScript', 'Web Development', TRUE),
('Mobile App UI', 'Clean and modern mobile app interface design', 'assets/images/portfolio/project2.jpg', '', '', 'Figma, Adobe XD', 'UI/UX Design', TRUE),
('Corporate Website', 'Professional corporate website with CMS', 'assets/images/portfolio/project3.jpg', 'https://example.com', 'https://github.com/example', 'WordPress, PHP, CSS3', 'Web Development', FALSE);

-- Insert sample testimonials
INSERT INTO testimonials (client_name, client_position, client_company, testimonial, rating) VALUES 
('John Smith', 'CEO', 'TechCorp', 'Excellent work! The website exceeded our expectations and helped increase our sales by 40%.', 5),
('Sarah Johnson', 'Marketing Director', 'StartupXYZ', 'Professional, reliable, and delivered on time. Highly recommended!', 5),
('Mike Wilson', 'Founder', 'Digital Agency', 'Great attention to detail and excellent communication throughout the project.', 5);