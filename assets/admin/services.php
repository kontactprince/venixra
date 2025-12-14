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
    $title = sanitizeInput($_POST['title'] ?? '');
    $description = sanitizeInput($_POST['description'] ?? '');
    $price_range = sanitizeInput($_POST['price_range'] ?? '');
    $icon = sanitizeInput($_POST['icon'] ?? 'fas fa-code');
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    if ($action === 'add') {
        $query = "INSERT INTO services (title, description, price_range, icon, is_active) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        if ($stmt->execute([$title, $description, $price_range, $icon, $is_active])) {
            $message = 'Service added successfully!';
        } else {
            $error = 'Failed to add service.';
        }
    } elseif ($action === 'edit') {
        $id = (int)$_POST['id'];
        $query = "UPDATE services SET title = ?, description = ?, price_range = ?, icon = ?, is_active = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        if ($stmt->execute([$title, $description, $price_range, $icon, $is_active, $id])) {
            $message = 'Service updated successfully!';
        } else {
            $error = 'Failed to update service.';
        }
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM services WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$id])) {
        $message = 'Service deleted successfully!';
    } else {
        $error = 'Failed to delete service.';
    }
}

// Get services
$query = "SELECT * FROM services ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get service for editing
$service = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM services WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
}

$page_title = 'Services Management';
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
                            <a class="nav-link active" href="services.php">
                                <i class="fas fa-cogs me-2"></i>Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="portfolio.php">
                                <i class="fas fa-briefcase me-2"></i>Portfolio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="testimonials.php">
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
                    <h1 class="h2">Services Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="?action=add" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Add New Service
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
                        <h5><?php echo $action === 'add' ? 'Add New Service' : 'Edit Service'; ?></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <?php if ($action === 'edit'): ?>
                            <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                            <?php endif; ?>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Service Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="<?php echo htmlspecialchars($service['title'] ?? ''); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price_range" class="form-label">Price Range *</label>
                                    <input type="text" class="form-control" id="price_range" name="price_range" 
                                           value="<?php echo htmlspecialchars($service['price_range'] ?? ''); ?>" 
                                           placeholder="e.g., $500 - $2000" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($service['description'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="icon" class="form-label">Icon Class</label>
                                    <input type="text" class="form-control" id="icon" name="icon" 
                                           value="<?php echo htmlspecialchars($service['icon'] ?? 'fas fa-code'); ?>" 
                                           placeholder="e.g., fas fa-code">
                                    <small class="form-text text-muted">Use Font Awesome icon classes</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                               <?php echo ($service['is_active'] ?? 1) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_active">
                                            Active Service
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i><?php echo $action === 'add' ? 'Add Service' : 'Update Service'; ?>
                                </button>
                                <a href="services.php" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <!-- Services List -->
                <div class="card">
                    <div class="card-header">
                        <h5>All Services</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($services)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No services found</h5>
                            <p class="text-muted">Add your first service to get started.</p>
                            <a href="?action=add" class="btn btn-primary">Add Service</a>
                        </div>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price Range</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($services as $service): ?>
                                    <tr>
                                        <td>
                                            <i class="<?php echo htmlspecialchars($service['icon']); ?> fa-lg text-primary"></i>
                                        </td>
                                        <td><?php echo htmlspecialchars($service['title']); ?></td>
                                        <td><?php echo htmlspecialchars(substr($service['description'], 0, 100)) . '...'; ?></td>
                                        <td><?php echo htmlspecialchars($service['price_range']); ?></td>
                                        <td>
                                            <?php if($service['is_active']): ?>
                                            <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                            <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="?action=edit&id=<?php echo $service['id']; ?>" 
                                                   class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?delete=<?php echo $service['id']; ?>" 
                                                   class="btn btn-outline-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this service?')" 
                                                   title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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