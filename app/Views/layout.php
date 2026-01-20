<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' | ' : '' ?>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <?php if (str_starts_with(uri_string(), 'admin')): ?>
        <?= $this->include('admin/_header') ?>
    <?php else: ?>
        <?= $this->include('_navbar') ?>
    <?php endif; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php if (session()->has('admin_id')): ?>
                <?= $this->include('admin/_sidebar') ?>
                <div class="col-md-10 main-content">
            <?php else: ?>
                <div class="col-12">
            <?php endif; ?>
                    
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-check-circle"></i> <?= session('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?= session('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Validation Errors:</strong>
                        <ul class="mt-2 mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                    <?= $this->renderSection('content') ?>
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>
