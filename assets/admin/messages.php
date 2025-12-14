<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

$message = '';
$error = '';

// Handle mark as read
if (isset($_GET['mark_read'])) {
    $id = (int)$_GET['mark_read'];
    $query = "UPDATE contact_messages SET is_read = 1 WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$id])) {
        $message = 'Message marked as read!';
    } else {
        $error = 'Failed to mark message as read.';
    }
}

// Handle mark as unread
if (isset($_GET['mark_unread'])) {
    $id = (int)$_GET['mark_unread'];
    $query = "UPDATE contact_messages SET is_read = 0 WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$id])) {
        $message = 'Message marked as unread!';
    } else {
        $error = 'Failed to mark message as unread.';
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = $db->prepare($query);
    if ($stmt->execute([$id])) {
        $message = 'Message deleted successfully!';
    } else {
        $error = 'Failed to delete message.';
    }
}

// Handle mark all as read
if (isset($_POST['mark_all_read'])) {
    $query = "UPDATE contact_messages SET is_read = 1";
    $stmt = $db->prepare($query);
    if ($stmt->execute()) {
        $message = 'All messages marked as read!';
    } else {
        $error = 'Failed to mark all messages as read.';
    }
}

// Get filter
$filter = $_GET['filter'] ?? 'all';
$where_clause = '';
$params = [];

if ($filter === 'unread') {
    $where_clause = 'WHERE is_read = 0';
} elseif ($filter === 'read') {
    $where_clause = 'WHERE is_read = 1';
}

// Get messages
$query = "SELECT * FROM contact_messages $where_clause ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute($params);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get message details
$message_detail = null;
if (isset($_GET['view'])) {
    $id = (int)$_GET['view'];
    $query = "SELECT * FROM contact_messages WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $message_detail = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Mark as read when viewing
    if ($message_detail && !$message_detail['is_read']) {
        $query = "UPDATE contact_messages SET is_read = 1 WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }
}

$page_title = 'Messages';
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
                            <a class="nav-link" href="testimonials.php">
                                <i class="fas fa-quote-left me-2"></i>Testimonials
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="messages.php">
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
                    <h1 class="h2">Messages</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <form method="POST" class="d-inline">
                            <button type="submit" name="mark_all_read" class="btn btn-outline-primary me-2">
                                <i class="fas fa-check-double me-1"></i>Mark All as Read
                            </button>
                        </form>
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

                <div class="row">
                    <!-- Messages List -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Messages</h6>
                                    <div class="btn-group btn-group-sm">
                                        <a href="?filter=all" class="btn btn-outline-primary <?php echo $filter === 'all' ? 'active' : ''; ?>">All</a>
                                        <a href="?filter=unread" class="btn btn-outline-warning <?php echo $filter === 'unread' ? 'active' : ''; ?>">Unread</a>
                                        <a href="?filter=read" class="btn btn-outline-success <?php echo $filter === 'read' ? 'active' : ''; ?>">Read</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <?php if (empty($messages)): ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-envelope fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">No messages found</p>
                                </div>
                                <?php else: ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach($messages as $msg): ?>
                                    <a href="?view=<?php echo $msg['id']; ?>" 
                                       class="list-group-item list-group-item-action <?php echo $message_detail && $message_detail['id'] == $msg['id'] ? 'active' : ''; ?>">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><?php echo htmlspecialchars($msg['name']); ?></h6>
                                            <small><?php echo date('M j, Y', strtotime($msg['created_at'])); ?></small>
                                        </div>
                                        <p class="mb-1 text-truncate"><?php echo htmlspecialchars($msg['subject'] ?: 'No Subject'); ?></p>
                                        <small>
                                            <?php echo htmlspecialchars($msg['email']); ?>
                                            <?php if(!$msg['is_read']): ?>
                                            <span class="badge bg-warning ms-2">New</span>
                                            <?php endif; ?>
                                        </small>
                                    </a>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Message Detail -->
                    <div class="col-lg-8">
                        <?php if ($message_detail): ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Message Details</h6>
                                    <div class="btn-group btn-group-sm">
                                        <?php if($message_detail['is_read']): ?>
                                        <a href="?mark_unread=<?php echo $message_detail['id']; ?>" class="btn btn-outline-warning">
                                            <i class="fas fa-envelope me-1"></i>Mark Unread
                                        </a>
                                        <?php else: ?>
                                        <a href="?mark_read=<?php echo $message_detail['id']; ?>" class="btn btn-outline-success">
                                            <i class="fas fa-envelope-open me-1"></i>Mark Read
                                        </a>
                                        <?php endif; ?>
                                        <a href="?delete=<?php echo $message_detail['id']; ?>" 
                                           class="btn btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete this message?')">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>From:</strong> <?php echo htmlspecialchars($message_detail['name']); ?><br>
                                        <strong>Email:</strong> 
                                        <a href="mailto:<?php echo htmlspecialchars($message_detail['email']); ?>">
                                            <?php echo htmlspecialchars($message_detail['email']); ?>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Date:</strong> <?php echo date('F j, Y \a\t g:i A', strtotime($message_detail['created_at'])); ?><br>
                                        <strong>Status:</strong> 
                                        <?php if($message_detail['is_read']): ?>
                                        <span class="badge bg-success">Read</span>
                                        <?php else: ?>
                                        <span class="badge bg-warning">Unread</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <?php if($message_detail['subject']): ?>
                                <div class="mb-3">
                                    <strong>Subject:</strong> <?php echo htmlspecialchars($message_detail['subject']); ?>
                                </div>
                                <?php endif; ?>
                                
                                <div>
                                    <strong>Message:</strong>
                                    <div class="mt-2 p-3 bg-light rounded">
                                        <?php echo nl2br(htmlspecialchars($message_detail['message'])); ?>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="mailto:<?php echo htmlspecialchars($message_detail['email']); ?>?subject=Re: <?php echo urlencode($message_detail['subject'] ?: 'Your Message'); ?>" 
                                       class="btn btn-primary">
                                        <i class="fas fa-reply me-1"></i>Reply
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Select a message to view details</h5>
                                <p class="text-muted">Choose a message from the list to read its content.</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>