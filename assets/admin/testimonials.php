<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? 'list';
$message = '';
$error = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = sanitizeInput($_POST['client_name'] ?? '');
    $client_position = sanitizeInput($_POST['client_position'] ?? '');
    $client_company = sanitizeInput($_POST['client_company'] ?? '');
    $testimonial = sanitizeInput($_POST['testimonial'] ?? '');
    $client_image = sanitizeInput($_POST['client_image'] ?? '');
    $rating = (int)($_POST['rating'] ?? 5);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    if ($action === 'add') {
        $query = "INSERT INTO testimonials (client_name, client_position, client_company, testimonial, client_image, rating, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        if ($stmt->execute([$client_name, $client_position, $client_company, $testimonial, $client_image, $rating, $is_active])) {
            $message = 'Testimonial added successfully!';
        } else {
            $error = 'Failed to add testimonial.';
        }
    } elseif ($action === 'edit') {
        $id = (int)$_POST['id'];
        $query = "UPDATE testimonials SET client_name = ?, client_position = ?, client_company = ?, testimonial = ?, client_image = ?, rating = ?, is_active = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        if ($stmt->execute([$client_name, $client_position, $client_company, $testimonial, $client_image, $rating, $is_active, $id])) {
            $message = 'Testimonial updated successfully!';
        } else {
            $error = 'Failed to update testimonial.';
        }
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM testimonials WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$id])) {
        $message = 'Testimonial deleted successfully!';
    } else {
        $error = 'Failed to delete testimonial.';
    }
}

// Get testimonials
$query = "SELECT * FROM testimonials ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get testimonial for editing
$testimonial = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM testimonials WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $testimonial = $stmt->fetch(PDO::FETCH_ASSOC);
}

$page_title = 'Testimonials Management';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - <?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h5 class="text-light">Admin Panel</h5>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">
                                <i class="fas fa-cogs me-2"></i>Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="portfolio.php">
                                <i class="fas fa-briefcase me-2"></i>Portfolio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="testimonials.php">
                                <i class="fas fa-quote-left me-2"></i>Testimonials
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="messages.php">
                                <i class="fas fa-envelope me-2"></i>Messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="../index.php" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>View Website
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Testimonials Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="?action=add" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Add New Testimonial
                        </a>
                    </div>
                </div>

                <?php if ($message): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <?php if ($action === 'add' || $action === 'edit'): ?>
                <!-- Add/Edit Form -->
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo $action === 'add' ? 'Add New Testimonial' : 'Edit Testimonial'; ?></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <?php if ($action === 'edit'): ?>
                            <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                            <?php endif; ?>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="client_name" class="form-label">Client Name *</label>
                                    <input type="text" class="form-control" id="client_name" name="client_name" 
                                           value="<?php echo htmlspecialchars($testimonial['client_name'] ?? ''); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_position" class="form-label">Client Position</label>
                                    <input type="text" class="form-control" id="client_position" name="client_position" 
                                           value="<?php echo htmlspecialchars($testimonial['client_position'] ?? ''); ?>" 
                                           placeholder="e.g., CEO, Marketing Director">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="client_company" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="client_company" name="client_company" 
                                           value="<?php echo htmlspecialchars($testimonial['client_company'] ?? ''); ?>" 
                                           placeholder="e.g., TechCorp Inc.">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="rating" class="form-label">Rating *</label>
                                    <select class="form-select" id="rating" name="rating" required>
                                        <option value="5" <?php echo ($testimonial['rating'] ?? 5) == 5 ? 'selected' : ''; ?>>5 Stars</option>
                                        <option value="4" <?php echo ($testimonial['rating'] ?? 5) == 4 ? 'selected' : ''; ?>>4 Stars</option>
                                        <option value="3" <?php echo ($testimonial['rating'] ?? 5) == 3 ? 'selected' : ''; ?>>3 Stars</option>
                                        <option value="2" <?php echo ($testimonial['rating'] ?? 5) == 2 ? 'selected' : ''; ?>>2 Stars</option>
                                        <option value="1" <?php echo ($testimonial['rating'] ?? 5) == 1 ? 'selected' : ''; ?>>1 Star</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="testimonial" class="form-label">Testimonial Text *</label>
                                <textarea class="form-control" id="testimonial" name="testimonial" rows="4" required><?php echo htmlspecialchars($testimonial['testimonial'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="client_image" class="form-label">Client Image URL</label>
                                <input type="url" class="form-control" id="client_image" name="client_image" 
                                       value="<?php echo htmlspecialchars($testimonial['client_image'] ?? ''); ?>" 
                                       placeholder="https://example.com/client-photo.jpg">
                                <small class="form-text text-muted">Optional: URL to client's photo</small>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           <?php echo ($testimonial['is_active'] ?? 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="is_active">
                                        Active Testimonial (will be displayed on website)
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i><?php echo $action === 'add' ? 'Add Testimonial' : 'Update Testimonial'; ?>
                                </button>
                                <a href="testimonials.php" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <!-- Testimonials List -->
                <div class="card">
                    <div class="card-header">
                        <h5>All Testimonials</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($testimonials)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-quote-left fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No testimonials found</h5>
                            <p class="text-muted">Add your first testimonial to build trust with potential clients.</p>
                            <a href="?action=add" class="btn btn-primary">Add Testimonial</a>
                        </div>
                        <?php else: ?>
                        <div class="row">
                            <?php foreach($testimonials as $testimonial): ?>
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <?php if($testimonial['client_image']): ?>
                                            <img src="<?php echo htmlspecialchars($testimonial['client_image']); ?>" 
                                                 class="rounded-circle me-3" 
                                                 alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                            <?php else: ?>
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <?php endif; ?>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1"><?php echo htmlspecialchars($testimonial['client_name']); ?></h6>
                                                <?php if($testimonial['client_position']): ?>
                                                <small class="text-muted"><?php echo htmlspecialchars($testimonial['client_position']); ?></small>
                                                <?php endif; ?>
                                                <?php if($testimonial['client_company']): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars($testimonial['client_company']); ?></small>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-end">
                                                <div class="mb-1">
                                                    <?php for($i = 1; $i <= $testimonial['rating']; $i++): ?>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <?php if($testimonial['is_active']): ?>
                                                <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <p class="card-text">"<?php echo htmlspecialchars($testimonial['testimonial']); ?>"</p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group w-100">
                                            <a href="?action=edit&id=<?php echo $testimonial['id']; ?>" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="?delete=<?php echo $testimonial['id']; ?>" 
                                               class="btn btn-outline-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>