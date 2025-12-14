<?php
require_once 'config/database.php';

// Sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get all services
function getServices() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM services WHERE is_active = 1 ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get featured portfolio projects
function getFeaturedPortfolio() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM portfolio WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 6";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get all portfolio projects
function getAllPortfolio() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM portfolio ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get active testimonials
function getTestimonials() {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT * FROM testimonials WHERE is_active = 1 ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Save contact message
function saveContactMessage($name, $email, $subject, $message) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    
    return $stmt->execute([$name, $email, $subject, $message]);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect to login if not authenticated
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: admin/login.php');
        exit();
    }
}

// Generate CSRF token
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify CSRF token
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>