<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

// Get statistics
$stats = [];

// Total services
$query = "SELECT COUNT(*) as count FROM services WHERE is_active = 1";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['services'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

// Total portfolio projects
$query = "SELECT COUNT(*) as count FROM portfolio";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['portfolio'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

// Total testimonials
$query = "SELECT COUNT(*) as count FROM testimonials WHERE is_active = 1";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['testimonials'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

// Unread messages
$query = "SELECT COUNT(*) as count FROM contact_messages WHERE is_read = 0";
$stmt = $db->prepare($query);
$stmt->execute();
$stats['unread_messages'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

// Recent messages
$query = "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5";
$stmt = $db->prepare($query);
$stmt->execute();
$recent_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = 'Dashboard';
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
                            <a class="nav-link active" href="dashboard.php">
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
                            <a class="nav-link" href="testimonials.php">
                                <i class="fas fa-quote-left me-2"></i>Testimonials
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="messages.php">
                                <i class="fas fa-envelope me-2"></i>Messages
                                <?php if($stats['unread_messages'] > 0): ?>
                                <span class="badge bg-danger ms-2"><?php echo $stats['unread_messages']; ?></span>
                                <?php endif; ?>
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
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-download me-1"></i>Export
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Services</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stats['services']; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cogs fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Portfolio</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stats['portfolio']; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Testimonials</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stats['testimonials']; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-quote-left fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">New Messages</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $stats['unread_messages']; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Messages -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Recent Messages</h6>
                                <a href="messages.php" class="btn btn-sm btn-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if(empty($recent_messages)): ?>
                                <p class="text-muted text-center">No messages yet</p>
                                <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($recent_messages as $message): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($message['name']); ?></td>
                                                <td><?php echo htmlspecialchars($message['email']); ?></td>
                                                <td><?php echo htmlspecialchars($message['subject'] ?: 'No Subject'); ?></td>
                                                <td><?php echo date('M j, Y', strtotime($message['created_at'])); ?></td>
                                                <td>
                                                    <?php if($message['is_read']): ?>
                                                    <span class="badge bg-success">Read</span>
                                                    <?php else: ?>
                                                    <span class="badge bg-warning">Unread</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="services.php?action=add" class="list-group-item list-group-item-action">
                                        <i class="fas fa-plus me-2"></i>Add New Service
                                    </a>
                                    <a href="portfolio.php?action=add" class="list-group-item list-group-item-action">
                                        <i class="fas fa-plus me-2"></i>Add Portfolio Project
                                    </a>
                                    <a href="testimonials.php?action=add" class="list-group-item list-group-item-action">
                                        <i class="fas fa-plus me-2"></i>Add Testimonial
                                    </a>
                                    <a href="messages.php" class="list-group-item list-group-item-action">
                                        <i class="fas fa-envelope me-2"></i>View Messages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>