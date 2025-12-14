<?php
// Site configuration
define('SITE_NAME', 'Your Name - Freelance Developer');
define('SITE_URL', 'http://localhost/company');
define('ADMIN_EMAIL', 'admin@example.com');

// Email configuration (for PHPMailer)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_FROM_EMAIL', 'your-email@gmail.com');
define('SMTP_FROM_NAME', 'Your Name');

// File upload paths
define('UPLOAD_PATH', 'assets/uploads/');
define('PORTFOLIO_IMAGES', 'assets/images/portfolio/');

// Session configuration
session_start();

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>