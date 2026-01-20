<?php
// app/Views/events/index.php
?>
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
            background: #f8f9fa;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 20px;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px 0;
            margin-bottom: 40px;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }
        
        .page-header p {
            opacity: 0.95;
            font-size: 1.1rem;
        }
        
        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
        }
        
        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2) !important;
        }
        
        .event-card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
        }
        
        .event-card-header h5 {
            margin: 0;
            font-weight: 600;
        }
        
        .badge-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 8px;
        }
        
        .badge-open {
            background: #28a745;
            color: white;
        }
        
        .badge-closing {
            background: #ffc107;
            color: #333;
        }
        
        .badge-closed {
            background: #dc3545;
            color: white;
        }
        
        .event-detail {
            display: flex;
            align-items: center;
            margin: 10px 0;
            font-size: 0.95rem;
        }
        
        .event-detail i {
            width: 20px;
            color: #667eea;
            margin-right: 8px;
        }
        
        .countdown {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.85rem;
            color: #666;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
        }
        
        .btn-register:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }
        
        .footer {
            background: #333;
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        .no-events {
            text-align: center;
            padding: 60px 20px;
        }
        
        .no-events i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 20px;
        }
    </style>
    <script>
        console.log('Events page loaded');
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-calendar"></i> Event Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('events') ?>">Events</a>
                    </li>
                    <?php if (session()->get('user_id')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard') ?>">My Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout') ?>">Logout (<?= htmlspecialchars(session()->get('user_name')) ?>)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register') ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-list"></i> All Events</h1>
            <p class="mb-0">Browse and register for upcoming events</p>
        </div>
    </div>

    <div class="container py-5">
        <!-- Error/Success Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> 
                <strong>Error!</strong> <?= htmlspecialchars(session()->getFlashdata('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> 
                <strong>Success!</strong> <?= htmlspecialchars(session()->getFlashdata('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form method="get" action="<?= base_url('events') ?>" class="d-flex gap-2">
                    <input type="text" 
                           name="search" 
                           id="searchEvents" 
                           class="form-control form-control-lg" 
                           placeholder="🔍 Search events by title, location, or description..."
                           value="<?= htmlspecialchars($search_query ?? '') ?>">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-search"></i> Search
                    </button>
                    <?php if (isset($search_query)): ?>
                        <a href="<?= base_url('events') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    <?php endif; ?>
                </form>
                <?php if (isset($search_query)): ?>
                    <div class="mt-2 text-muted">
                        <small>Showing results for: <strong>"<?= htmlspecialchars($search_query) ?>"</strong></small>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($events)): ?>
            <div class="row">
                <?php foreach ($events as $event): 
                    $eventDate = new DateTime($event['date']);
                    // Fallback if deadline is missing
                    $regDeadlineStr = $event['registration_deadline'] ?? $event['date'];
                    $regDeadline = new DateTime($regDeadlineStr);
                    $today = new DateTime();
                    
                    if ($regDeadline < $today) {
                        $statusText = 'Registration Closed';
                        $statusClass = 'badge-closed';
                    } else if ($regDeadline->diff($today)->days <= 3) {
                        $statusText = 'Closing Soon';
                        $statusClass = 'badge-closing';
                    } else {
                        $statusText = 'Open';
                        $statusClass = 'badge-open';
                    }
                    
                    $daysUntilEvent = $eventDate->diff($today)->days;
                    $daysUntilDeadline = $regDeadline->diff($today)->days;
                ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card shadow-sm">
                            <div class="event-card-header">
                                <h5><?= htmlspecialchars($event['title']) ?></h5>
                                <span class="badge-status <?= $statusClass ?>"><?= $statusText ?></span>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-muted mb-3"><?= substr(htmlspecialchars($event['description']), 0, 100) ?>...</p>
                                
                                <div class="event-detail">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span><?= date('F d, Y', strtotime($event['date'])) ?></span>
                                </div>
                                
                                <div class="event-detail">
                                    <i class="fas fa-clock"></i>
                                    <span><?= $event['time'] ?></span>
                                </div>
                                
                                <div class="event-detail">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= htmlspecialchars($event['location']) ?></span>
                                </div>
                                
                                <hr>
                                
                                <div class="countdown">
                                    <i class="fas fa-hourglass-end"></i> 
                                    <strong>Registration Deadline:</strong> 
                                    <br><?= $regDeadline->format('F d, Y') ?>
                                    <br><small><?= $daysUntilDeadline ?> day(s) remaining</small>
                                </div>
                                
                                <div class="countdown mt-2">
                                    <i class="fas fa-rocket"></i> 
                                    <strong>Event starts in:</strong> <?= $daysUntilEvent ?> day(s)
                                </div>
                                
                                <div class="mt-3">
                                    <?php if (session()->get('user_id')): ?>
                                        <a href="<?= base_url('event/' . $event['id']) ?>" class="btn btn-register w-100">
                                            <i class="fas fa-ticket-alt"></i> Register Now
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= base_url('login') ?>" class="btn btn-register w-100">
                                            <i class="fas fa-sign-in-alt"></i> Login to Register
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                <h3>No Events Available</h3>
                <p>Check back soon for upcoming events!</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p class="mb-0">&copy; 2026 Event Management System. All rights reserved.</p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script>
        console.log('Events page fully rendered');
    </script>
</body>
</html>
