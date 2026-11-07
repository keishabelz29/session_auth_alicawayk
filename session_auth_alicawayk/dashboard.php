<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$active_session_id = session_id();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h1 fw-bold">SessionAuthSystem Dashboard</span>
        <div class="d-flex align-items-center gap-2">
            <span class="text-white small me-1"><i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($username); ?></span>
            <a href="logout.php" class="btn btn-danger btn-sm px-3"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </nav>

    <div class="container mt-4">


        <!-- Top Welcome Card -->
        <div class="card shadow-sm p-4 border-0 bg-white mb-4">
            <h1 class="fw-bold text-dark mb-2">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
            <p class="text-muted mb-4">This page is protected and only visible to logged-in users.</p>
            <div>
                <a href="#" class="btn btn-primary px-4">Explore Dashboard</a>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3 bg-white border-start border-4 border-success">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                            <i class="bi bi-shield-check fs-3"></i>
                        </div>
                        <div>
                            <span class="text-success small fw-bold text-capitalize d-block mb-1">Account Status</span>
                            <small class="text-dark d-block" style="font-size: 0.85rem;">
                                Your session is active and protected against Session Fixation using <code class="text-danger">session_regenerate_id(true)</code>.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3 bg-white border-start border-4 border-primary">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                            <i class="bi bi-person-badge fs-3"></i>
                        </div>
                        <div>
                            <span class="text-primary small fw-bold text-capitalize d-block mb-1">User Details</span>
                            <div class="small text-dark">
                                <div><strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?></div>
                                <div class="mt-1"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-3 bg-white border-start border-4 border-warning">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-3 me-3">
                            <i class="bi bi-key-fill fs-3"></i>
                        </div>
                        <div style="overflow: hidden;">
                            <span class="text-warning small fw-bold text-capitalize d-block mb-1">Active Session ID</span>
                            <div class="small text-dark">
                                <div><strong>Current Session ID:</strong></div>
                                <div class="font-monospace text-muted text-truncate mt-1 bg-light p-1 rounded border">
                                    <?php echo htmlspecialchars($active_session_id); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>


</body>
</html>