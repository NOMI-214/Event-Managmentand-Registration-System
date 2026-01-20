<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 20px;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            margin: 0;
            font-weight: 600;
        }
        
        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 8px;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        
        .event-card .card-title {
            color: #333;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        
        .footer {
            background: #f8f9fa;
            padding: 20px 0;
            margin-top: 40px;
            border-top: 1px solid #ddd;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            margin-bottom: 30px;
        }
    </style>
    <script>
        console.log('Dashboard page loaded');
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>" onclick="console.log('Home clicked')">
                <i class="fas fa-calendar"></i> Event Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>" onclick="console.log('Home link clicked')">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('events') ?>" onclick="console.log('Events link clicked')">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('dashboard') ?>" onclick="console.log('Dashboard link clicked')">My Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>" onclick="console.log('Logout clicked')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-user-circle"></i> My Dashboard</h1>
            <p class="mb-0">View and manage your registered events</p>
        </div>
    </div>

    <div class="container py-4">
        <!-- Error/Success Messages -->
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> 
                <strong>Error!</strong> <?= htmlspecialchars(session()->get('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                console.error('Error: <?= session()->get('error') ?>');
            </script>
        <?php endif; ?>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> 
                <strong>Success!</strong> <?= htmlspecialchars(session()->get('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                console.log('Success: <?= session()->get('success') ?>');
            </script>
        <?php endif; ?>

        <div class="welcome-card p-4">
            <h4 class="mb-2">Welcome, <?= htmlspecialchars(session()->get('user_name')) ?>!</h4>
            <p class="mb-0">You have registered for <?= count($events) ?> event(s).</p>
        </div>

        <?php if (!empty($events)): ?>
            <div class="row">
                <?php foreach ($events as $event): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 event-card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                                <p class="card-text text-muted"><?= substr(htmlspecialchars($event['description']), 0, 80) ?>...</p>
                                
                                <div class="mb-3 small">
                                    <p class="mb-1">
                                        <i class="fas fa-calendar-alt text-primary"></i> 
                                        <?= date('F d, Y', strtotime($event['date'])) ?>
                                    </p>
                                    <p class="mb-1">
                                        <i class="fas fa-clock text-info"></i> 
                                        <?= $event['time'] ?>
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-map-marker-alt text-danger"></i> 
                                        <?= htmlspecialchars($event['location']) ?>
                                    </p>
                                </div>

                                <div class="alert alert-success mb-2 py-2 px-3 small">
                                    <i class="fas fa-check-circle"></i> Registered on <?= date('F d, Y', strtotime($event['registered_at'])) ?>
                                </div>
                                
                                <a href="<?= base_url('event/' . $event['id']) ?>" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-calendar-times fa-3x mb-3 d-block"></i>
                <h5>No Events Registered</h5>
                <p class="mb-3">You haven't registered for any events yet.</p>
                <a href="<?= base_url('events') ?>" class="btn btn-primary">
                    <i class="fas fa-search"></i> Browse Events
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Event Management System. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        console.log('Dashboard fully loaded');
        console.log('Base URL:', '<?= base_url() ?>');
    </script>
</body>
</html>
