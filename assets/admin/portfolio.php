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
    $image_url = sanitizeInput($_POST['image_url'] ?? '');
    $project_url = sanitizeInput($_POST['project_url'] ?? '');
    $github_url = sanitizeInput($_POST['github_url'] ?? '');
    $technologies = sanitizeInput($_POST['technologies'] ?? '');
    $category = sanitizeInput($_POST['category'] ?? 'Web Development');
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    if ($action === 'add') {
        $query = "INSERT INTO portfolio (title, description, image_url, project_url, github_url, technologies, category, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        if ($stmt->execute([$title, $description, $image_url, $project_url, $github_url, $technologies, $category, $is_featured])) {
            $message = 'Portfolio project added successfully!';
        } else {
            $error = 'Failed to add portfolio project.';
        }
    } elseif ($action === 'edit') {
        $id = (int)$_POST['id'];
        $query = "UPDATE portfolio SET title = ?, description = ?, image_url = ?, project_url = ?, github_url = ?, technologies = ?, category = ?, is_featured = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        if ($stmt->execute([$title, $description, $image_url, $project_url, $github_url, $technologies, $category, $is_featured, $id])) {
            $message = 'Portfolio project updated successfully!';
        } else {
            $error = 'Failed to update portfolio project.';
        }
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM portfolio WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$id])) {
        $message = 'Portfolio project deleted successfully!';
    } else {
        $error = 'Failed to delete portfolio project.';
    }
}

// Get portfolio projects
$query = "SELECT * FROM portfolio ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$portfolio = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get project for editing
$project = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT * FROM portfolio WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);
}

$page_title = 'Portfolio Management';
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
                            <a class="nav-link active" href="portfolio.php">
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
                    <h1 class="h2">Portfolio Management</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="?action=add" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Add New Project
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
                        <h5><?php echo $action === 'add' ? 'Add New Project' : 'Edit Project'; ?></h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <?php if ($action === 'edit'): ?>
                            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                            <?php endif; ?>
                            
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="title" class="form-label">Project Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="<?php echo htmlspecialchars($project['title'] ?? ''); ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="category" class="form-label">Category *</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="Web Development" <?php echo ($project['category'] ?? '') === 'Web Development' ? 'selected' : ''; ?>>Web Development</option>
                                        <option value="UI/UX Design" <?php echo ($project['category'] ?? '') === 'UI/UX Design' ? 'selected' : ''; ?>>UI/UX Design</option>
                                        <option value="Mobile App" <?php echo ($project['category'] ?? '') === 'Mobile App' ? 'selected' : ''; ?>>Mobile App</option>
                                        <option value="E-commerce" <?php echo ($project['category'] ?? '') === 'E-commerce' ? 'selected' : ''; ?>>E-commerce</option>
                                        <option value="Other" <?php echo ($project['category'] ?? '') === 'Other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Project Description *</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="image_url" class="form-label">Image URL *</label>
                                    <input type="url" class="form-control" id="image_url" name="image_url" 
                                           value="<?php echo htmlspecialchars($project['image_url'] ?? ''); ?>" 
                                           placeholder="https://example.com/image.jpg" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="technologies" class="form-label">Technologies Used *</label>
                                    <input type="text" class="form-control" id="technologies" name="technologies" 
                                           value="<?php echo htmlspecialchars($project['technologies'] ?? ''); ?>" 
                                           placeholder="PHP, MySQL, Bootstrap, JavaScript" required>
                                    <small class="form-text text-muted">Separate technologies with commas</small>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="project_url" class="form-label">Live Demo URL</label>
                                    <input type="url" class="form-control" id="project_url" name="project_url" 
                                           value="<?php echo htmlspecialchars($project['project_url'] ?? ''); ?>" 
                                           placeholder="https://example.com">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="github_url" class="form-label">GitHub URL</label>
                                    <input type="url" class="form-control" id="github_url" name="github_url" 
                                           value="<?php echo htmlspecialchars($project['github_url'] ?? ''); ?>" 
                                           placeholder="https://github.com/username/project">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                           <?php echo ($project['is_featured'] ?? 0) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Project (will appear on homepage)
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i><?php echo $action === 'add' ? 'Add Project' : 'Update Project'; ?>
                                </button>
                                <a href="portfolio.php" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <!-- Portfolio List -->
                <div class="card">
                    <div class="card-header">
                        <h5>All Portfolio Projects</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($portfolio)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No projects found</h5>
                            <p class="text-muted">Add your first project to showcase your work.</p>
                            <a href="?action=add" class="btn btn-primary">Add Project</a>
                        </div>
                        <?php else: ?>
                        <div class="row">
                            <?php foreach($portfolio as $project): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>" 
                                         class="card-img-top" 
                                         alt="<?php echo htmlspecialchars($project['title']); ?>"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title"><?php echo htmlspecialchars($project['title']); ?></h6>
                                            <?php if($project['is_featured']): ?>
                                            <span class="badge bg-warning">Featured</span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="card-text text-muted small">
                                            <?php echo htmlspecialchars(substr($project['description'], 0, 100)) . '...'; ?>
                                        </p>
                                        <div class="mb-2">
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($project['category']); ?></span>
                                        </div>
                                        <div class="d-flex gap-1">
                                            <?php 
                                            $technologies = explode(',', $project['technologies']);
                                            foreach(array_slice($technologies, 0, 3) as $tech): 
                                            ?>
                                            <span class="badge bg-secondary"><?php echo trim($tech); ?></span>
                                            <?php endforeach; ?>
                                            <?php if(count($technologies) > 3): ?>
                                            <span class="badge bg-light text-dark">+<?php echo count($technologies) - 3; ?> more</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group w-100">
                                            <a href="?action=edit&id=<?php echo $project['id']; ?>" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="?delete=<?php echo $project['id']; ?>" 
                                               class="btn btn-outline-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this project?')">
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