<?php
// app/Views/events/detail.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title']) ?> | Event Management System</title>
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
            padding: 30px 0;
            margin-bottom: 30px;
        }
        
        .card {
            border: none;
            border-radius: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        
        .event-header {
            border-bottom: 3px solid #667eea;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 20px 0;
            margin-top: 40px;
            border-top: 1px solid #ddd;
        }
    </style>
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
                        <a class="nav-link" href="<?= base_url('events') ?>">Events</a>
                    </li>
                    <?php if (session()->has('user_id')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('dashboard') ?>">My Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('logout') ?>">Logout (<?= htmlspecialchars(session()->get('user_name')) ?>)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('register') ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-calendar-alt"></i> Event Details</h1>
        </div>
    </div>

    <div class="container py-4">
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars(session()->get('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars(session()->get('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="card-title event-header"><?= htmlspecialchars($event['title']) ?></h1>
                        
                        <div class="alert alert-light border">
                            <p class="mb-1"><strong><i class="fas fa-calendar-alt text-primary"></i> Date & Time:</strong></p>
                            <p class="mb-3">
                                <?= date('l, F d, Y', strtotime($event['date'])) ?> at <?= htmlspecialchars($event['time']) ?>
                            </p>
                            
                            <p class="mb-1"><strong><i class="fas fa-map-marker-alt text-danger"></i> Venue:</strong></p>
                            <p class="mb-3">
                                <?= htmlspecialchars($event['location']) ?>
                            </p>
                            
                            <p class="mb-1"><strong><i class="fas fa-chair text-success"></i> Available Seats:</strong></p>
                            <div class="progress mb-3">
                                <?php 
                                $percentageFilled = ($event['participant_count'] / $event['max_participants']) * 100;
                                $progressColor = $percentageFilled >= 80 ? 'danger' : ($percentageFilled >= 50 ? 'warning' : 'success');
                                ?>
                                <div class="progress-bar bg-<?= $progressColor ?>" role="progressbar" 
                                    style="width: <?= $percentageFilled ?>%"
                                    aria-valuenow="<?= $event['participant_count'] ?>" 
                                    aria-valuemin="0" 
                                    aria-valuemax="<?= $event['max_participants'] ?>">
                                </div>
                            </div>
                            <p class="mb-0">
                                <strong><?= $event['available_slots'] ?></strong> seats available out of 
                                <strong><?= $event['max_participants'] ?></strong> 
                                (<?= $event['participant_count'] ?> registered)
                            </p>
                        </div>

                        <h4 class="mt-4 mb-3">About This Event</h4>
                        <p class="card-text text-muted"><?= nl2br(htmlspecialchars($event['description'])) ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <?php if ($event['available_slots'] > 0): ?>
                    <div class="card shadow-sm sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-clipboard-list"></i> Register for Event
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= base_url('event/' . $event['id'] . '/register') ?>" id="registrationForm">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                        value="<?= htmlspecialchars(old('name')) ?>" 
                                        required 
                                        minlength="2" 
                                        maxlength="255"
                                        placeholder="Enter your full name">
                                    <div class="invalid-feedback">Please enter your full name (at least 2 characters)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                        value="<?= htmlspecialchars(old('email')) ?>" 
                                        required 
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                        maxlength="255"
                                        placeholder="Enter your email">
                                    <div class="invalid-feedback">Please enter a valid email address</div>
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                        value="<?= htmlspecialchars(old('phone')) ?>" 
                                        required 
                                        pattern="[0-9+\-\s()]{10,20}"
                                        minlength="10"
                                        maxlength="20"
                                        placeholder="Enter your phone number">
                                    <div class="invalid-feedback">Please enter a valid phone number (10-20 digits)</div>
                                </div>

                                <button type="submit" class="btn btn-success w-100 btn-lg">
                                    <i class="fas fa-check-circle"></i> Register Now
                                </button>
                            </form>

                            <div class="alert alert-info mt-3 small mb-0">
                                <i class="fas fa-info-circle"></i> You'll receive a confirmation email after registration.
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-times-circle fa-3x text-danger mb-3 d-block"></i>
                            <h5>Event Full</h5>
                            <p class="mb-0">Sorry! This event has reached its maximum capacity.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4">
            <a href="<?= base_url('events') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Events
            </a>
        </div>
    </div>

    <div class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Event Management System. All rights reserved.</p>
        </div>
    </div>

    <!-- Debug Console -->
    <div id="debugConsole" style="position: fixed; bottom: 0; left: 0; right: 0; background: #222; color: #0f0; padding: 10px; font-family: monospace; font-size: 12px; max-height: 200px; overflow-y: auto; display: none; z-index: 9999; border-top: 2px solid #0f0;">
        <div style="margin-bottom: 5px; cursor: pointer;" onclick="document.getElementById('debugConsole').style.display='none'">
            [Close Console] <span style="float: right;">×</span>
        </div>
        <div id="consoleLogs"></div>
    </div>

    <!-- Button to show console -->
    <button id="toggleConsole" style="position: fixed; bottom: 10px; right: 10px; padding: 8px 12px; background: #667eea; color: white; border: none; border-radius: 4px; cursor: pointer; z-index: 10000;">
        🖥️ Console
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script>
        // Debug Console Setup
        const consoleLogs = [];
        const maxLogs = 50;
        
        // Intercept console.log
        const originalLog = console.log;
        console.log = function(...args) {
            originalLog.apply(console, args);
            addLog('LOG', args.join(' '));
        };
        
        // Intercept console.error
        const originalError = console.error;
        console.error = function(...args) {
            originalError.apply(console, args);
            addLog('ERROR', args.join(' '), 'red');
        };
        
        // Intercept console.warn
        const originalWarn = console.warn;
        console.warn = function(...args) {
            originalWarn.apply(console, args);
            addLog('WARN', args.join(' '), 'yellow');
        };
        
        // Catch global errors
        window.addEventListener('error', function(e) {
            addLog('UNCAUGHT ERROR', e.message + ' at line ' + e.lineno, 'red');
        });
        
        function addLog(type, message, color = 'white') {
            const timestamp = new Date().toLocaleTimeString();
            const logEntry = `[${timestamp}] [${type}] ${message}`;
            consoleLogs.push({text: logEntry, color: color});
            
            if (consoleLogs.length > maxLogs) {
                consoleLogs.shift();
            }
            
            updateConsoleDisplay();
        }
        
        function updateConsoleDisplay() {
            const logsDiv = document.getElementById('consoleLogs');
            logsDiv.innerHTML = consoleLogs.map(log => 
                `<div style="color: ${log.color};">${log.text}</div>`
            ).join('');
            logsDiv.scrollTop = logsDiv.scrollHeight;
        }
        
        // Toggle console visibility
        document.getElementById('toggleConsole').addEventListener('click', function() {
            const console = document.getElementById('debugConsole');
            console.style.display = console.style.display === 'none' ? 'block' : 'none';
        });
        
        // Initial log
        console.log('Event Detail Page Loaded');
        console.log('Event ID: <?= htmlspecialchars($event['id'] ?? 'N/A') ?>');
        console.log('Event Title: <?= htmlspecialchars($event['title'] ?? 'N/A') ?>');
        console.log('Available Slots: <?= htmlspecialchars($event['available_slots'] ?? 'N/A') ?>');
    </script>
</body>
</html>
