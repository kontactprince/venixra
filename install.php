<?php
/**
 * Installation Script for Personal Freelancing Website
 * Run this script once to set up the database and initial configuration
 */

// Check if already installed
if (file_exists('config/installed.lock')) {
    die('Website is already installed. Delete config/installed.lock to reinstall.');
}

$step = $_GET['step'] ?? 1;
$error = '';
$success = '';

// Database connection test
if ($step == 2) {
    $host = $_POST['db_host'] ?? 'localhost';
    $name = $_POST['db_name'] ?? 'freelancing_website';
    $user = $_POST['db_user'] ?? 'root';
    $pass = $_POST['db_pass'] ?? '';
    
    try {
        $pdo = new PDO("mysql:host=$host", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create database if it doesn't exist
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name`");
        $pdo->exec("USE `$name`");
        
        // Read and execute schema
        $schema = file_get_contents('database/schema.sql');
        $pdo->exec($schema);
        
        // Update config file
        $config_content = file_get_contents('config/database.php');
        $config_content = str_replace("define('DB_HOST', 'localhost');", "define('DB_HOST', '$host');", $config_content);
        $config_content = str_replace("define('DB_NAME', 'freelancing_website');", "define('DB_NAME', '$name');", $config_content);
        $config_content = str_replace("define('DB_USER', 'root');", "define('DB_USER', '$user');", $config_content);
        $config_content = str_replace("define('DB_PASS', '');", "define('DB_PASS', '$pass');", $config_content);
        file_put_contents('config/database.php', $config_content);
        
        // Create installed lock file
        file_put_contents('config/installed.lock', date('Y-m-d H:i:s'));
        
        $success = 'Database setup completed successfully!';
        $step = 3;
    } catch (PDOException $e) {
        $error = 'Database connection failed: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation - Personal Freelancing Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .install-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .install-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }
        .install-body {
            padding: 40px;
        }
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
        }
        .step.active {
            background: #667eea;
            color: white;
        }
        .step.completed {
            background: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="install-card">
            <div class="install-header">
                <i class="fas fa-rocket fa-3x mb-3"></i>
                <h2>Website Installation</h2>
                <p class="mb-0">Personal Freelancing Website Setup</p>
            </div>
            <div class="install-body">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step <?php echo $step >= 1 ? ($step > 1 ? 'completed' : 'active') : ''; ?>">1</div>
                    <div class="step <?php echo $step >= 2 ? ($step > 2 ? 'completed' : 'active') : ''; ?>">2</div>
                    <div class="step <?php echo $step >= 3 ? 'active' : ''; ?>">3</div>
                </div>

                <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                </div>
                <?php endif; ?>

                <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                </div>
                <?php endif; ?>

                <?php if ($step == 1): ?>
                <!-- Step 1: Welcome -->
                <div class="text-center">
                    <h4>Welcome to the Installation</h4>
                    <p class="text-muted mb-4">This will set up your personal freelancing website with all the necessary components.</p>
                    
                    <h6>What will be installed:</h6>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>Database schema and sample data</li>
                        <li><i class="fas fa-check text-success me-2"></i>Admin panel with default credentials</li>
                        <li><i class="fas fa-check text-success me-2"></i>Sample content (services, portfolio, testimonials)</li>
                        <li><i class="fas fa-check text-success me-2"></i>Contact form functionality</li>
                    </ul>
                    
                    <h6 class="mt-4">Requirements:</h6>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-info-circle text-info me-2"></i>PHP 7.4 or higher</li>
                        <li><i class="fas fa-info-circle text-info me-2"></i>MySQL 5.7 or higher</li>
                        <li><i class="fas fa-info-circle text-info me-2"></i>Web server (Apache/Nginx)</li>
                    </ul>
                    
                    <a href="?step=2" class="btn btn-primary btn-lg mt-4">
                        <i class="fas fa-arrow-right me-2"></i>Start Installation
                    </a>
                </div>

                <?php elseif ($step == 2): ?>
                <!-- Step 2: Database Configuration -->
                <h4>Database Configuration</h4>
                <p class="text-muted mb-4">Enter your database connection details:</p>
                
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="db_host" class="form-label">Database Host</label>
                            <input type="text" class="form-control" id="db_host" name="db_host" value="localhost" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="db_name" class="form-label">Database Name</label>
                            <input type="text" class="form-control" id="db_name" name="db_name" value="freelancing_website" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="db_user" class="form-label">Database Username</label>
                            <input type="text" class="form-control" id="db_user" name="db_user" value="root" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="db_pass" class="form-label">Database Password</label>
                            <input type="password" class="form-control" id="db_pass" name="db_pass">
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-database me-2"></i>Setup Database
                        </button>
                        <a href="?step=1" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </form>

                <?php elseif ($step == 3): ?>
                <!-- Step 3: Installation Complete -->
                <div class="text-center">
                    <i class="fas fa-check-circle fa-4x text-success mb-4"></i>
                    <h4>Installation Complete!</h4>
                    <p class="text-muted mb-4">Your personal freelancing website has been successfully installed.</p>
                    
                    <div class="alert alert-info text-start">
                        <h6><i class="fas fa-key me-2"></i>Default Admin Credentials:</h6>
                        <ul class="mb-0">
                            <li><strong>Username:</strong> admin</li>
                            <li><strong>Email:</strong> admin@example.com</li>
                            <li><strong>Password:</strong> admin123</li>
                        </ul>
                        <small class="text-danger mt-2 d-block">⚠️ Please change these credentials immediately after login!</small>
                    </div>
                    
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="admin/login.php" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Go to Admin Panel
                        </a>
                        <a href="index.php" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>View Website
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Don't forget to customize your content, images, and contact information!
                        </small>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>