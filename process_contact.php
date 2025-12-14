<?php
require_once 'config/config.php';
require_once 'includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get form data
$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

// Validate required fields
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
    exit;
}

// Validate email
if (!validateEmail($email)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

// Set default subject if empty
if (empty($subject)) {
    $subject = 'New Contact Form Submission';
}

try {
    // Save to database
    $saved = saveContactMessage($name, $email, $subject, $message);
    
    if ($saved) {
        // Send email notification (if PHPMailer is configured)
        if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            sendEmailNotification($name, $email, $subject, $message);
        }
        
        echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save message. Please try again.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}

function sendEmailNotification($name, $email, $subject, $message) {
    try {
        // Include PHPMailer
        require_once 'vendor/autoload.php';
        
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;
        
        // Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress(ADMIN_EMAIL);
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form: ' . $subject;
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong></p>
            <p>{$message}</p>
            <hr>
            <p><small>This message was sent from your website contact form.</small></p>
        ";
        
        $mail->send();
        
        // Send auto-reply to client
        $mail->clearAddresses();
        $mail->addAddress($email, $name);
        $mail->Subject = 'Thank you for contacting us';
        $mail->Body = "
            <h3>Thank you for your message!</h3>
            <p>Hi {$name},</p>
            <p>Thank you for reaching out! I've received your message and will get back to you within 24 hours.</p>
            <p>Best regards,<br>Your Name</p>
        ";
        
        $mail->send();
        
    } catch (Exception $e) {
        // Log error but don't fail the form submission
        error_log("Email sending failed: " . $e->getMessage());
    }
}
?>