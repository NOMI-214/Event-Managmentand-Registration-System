<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-bold" href="<?= base_url('/') ?>">
            <i class="fas fa-calendar-alt"></i> EventSys
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('/') ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('events') ?>">
                        <i class="fas fa-calendar-alt"></i> Events
                    </a>
                </li>
                <?php if (session()->has('admin_id')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield"></i> Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/events') ?>">
                                <i class="fas fa-calendar-alt"></i> Manage Events
                            </a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/participants') ?>">
                                <i class="fas fa-users"></i> Participants
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= base_url('admin/login') ?>">
                            <i class="fas fa-lock"></i> Admin
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
