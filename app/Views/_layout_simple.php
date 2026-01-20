<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Event Registration System' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        .event-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-calendar-alt"></i> Event System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('events') ?>">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/login') ?>">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $content_html ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 Event Registration System. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
