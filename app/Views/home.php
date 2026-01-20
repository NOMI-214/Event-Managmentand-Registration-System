<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | UET Mardan Event System</title>
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
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 120px 0;
            text-align: center;
            margin-bottom: 50px;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        
        .hero-section p {
            font-size: 1.5rem;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .organizer-card {
            text-align: center;
            padding: 30px;
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .organizer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
        }
        
        .organizer-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%);
            color: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 20px;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .next-event-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.15);
            position: relative;
            overflow: hidden;
            border-left: 6px solid #667eea;
        }
        
        .live-badge {
            background: #dc3545;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-header h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        
        .section-header .line {
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            margin: 0 auto;
            border-radius: 2px;
        }

        .footer {
            background: #2d3748;
            color: white;
            padding: 40px 0;
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-calendar-alt"></i> EventSys
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('events') ?>">Events</a>
                    </li>
                    <?php if (session()->get('user_id')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard') ?>">My Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout') ?>">Logout</a>
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

    <div class="hero-section">
        <div class="container">
            <h1>University of Engineering and Technology Mardan</h1>
            <p>Official Event Management Portal</p>
            <div class="mt-4">
                <a href="<?= base_url('events') ?>" class="btn btn-light btn-lg text-primary fw-bold px-5 shadow">Browse Events</a>
            </div>
        </div>
    </div>

    <div class="container">
        
        <!-- Live / Upcoming Event Section -->
        <div class="section-header">
            <h2>Upcoming Live Event</h2>
            <div class="line"></div>
        </div>

        <?php if (!empty($upcomingEvents)): 
             $nextEvent = $upcomingEvents[0];
        ?>
            <div class="next-event-card mb-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center mb-3">
                            <span class="live-badge me-3"><i class="fas fa-circle me-1"></i> LIVE / UPCOMING Details</span>
                            <span class="text-muted"><i class="fas fa-calendar"></i> <?= date('F d, Y', strtotime($nextEvent['date'])) ?></span>
                        </div>
                        <h2 class="mb-3 text-dark"><?= htmlspecialchars($nextEvent['title']) ?></h2>
                        <p class="lead text-muted mb-4"><?= substr(htmlspecialchars($nextEvent['description']), 0, 150) ?>...</p>
                        
                        <div class="d-flex gap-4 text-secondary mb-4">
                            <div><i class="fas fa-clock text-primary me-2"></i> <?= $nextEvent['time'] ?></div>
                            <div><i class="fas fa-map-marker-alt text-danger me-2"></i> <?= htmlspecialchars($nextEvent['location']) ?></div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center border-start">
                        <div class="p-3">
                            <h4 class="mb-3">Join Us Now!</h4>
                            <a href="<?= base_url('event/' . $nextEvent['id']) ?>" class="btn btn-primary btn-lg w-100 mb-2 shadow-sm">
                                Register Now
                            </a>
                            <small class="text-muted d-block">Limited seats available</small>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center p-5 shadow-sm rounded-3">
                <i class="fas fa-calendar-times fa-3x mb-3 text-info"></i>
                <h4>No Upcoming Events</h4>
                <p>Stay tuned! New events will be announced shortly.</p>
            </div>
        <?php endif; ?>

        <!-- Organizers Team Section -->
        <div class="mt-5 pt-5">
            <div class="section-header">
                <h2>Our Organizer Team</h2>
                <div class="line"></div>
                <p class="text-muted mt-3">The dedicated team behind UET Mardan Events</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="organizer-card">
                        <div class="organizer-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h4>Muhammad Naveed</h4>
                        <p class="text-primary fw-bold mb-2">Event Organizer</p>
                        <p class="text-muted small">Leading the strategic vision and execution of campus events.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="organizer-card">
                        <div class="organizer-avatar">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h4>Muhammad Nouman</h4>
                        <p class="text-primary fw-bold mb-2">Technical Head</p>
                        <p class="text-muted small">Managing the technical infrastructure and digital experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="organizer-card">
                        <div class="organizer-avatar">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h4>Shahbaz Khan</h4>
                        <p class="text-primary fw-bold mb-2">Operations Manager</p>
                        <p class="text-muted small">Ensuring smooth logistics and participant coordination.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="footer">
        <div class="container text-center">
            <h3>University of Engineering and Technology Mardan</h3>
            <p class="mb-0">&copy; 2026 UET Mardan Event Management System. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
