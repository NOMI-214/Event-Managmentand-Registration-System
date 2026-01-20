<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); z-index: 1040;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-calendar-check text-white"></i> EventSys Admin
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <span class="nav-link text-white disabled">
                        <i class="fas fa-user-circle"></i> Administrator
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-danger" href="<?= base_url('admin/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
