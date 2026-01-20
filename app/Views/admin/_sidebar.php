<aside class="col-md-2 sidebar bg-white p-0 shadow-sm border-end" style="min-height: 100vh;">
    <style>
        .admin-sidebar-link {
            color: #4a5568 !important;
            padding: 14px 20px !important;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
        }
        .admin-sidebar-link:hover {
            color: #667eea !important;
            background: #f8f9ff;
            padding-left: 25px !important;
        }
        .admin-sidebar-link.active-link {
            color: #667eea !important;
            background: #f0f4ff;
            border-left-color: #667eea;
            font-weight: 600;
        }
        .admin-sidebar-link i {
            width: 30px;
            font-size: 1.1rem;
        }
        .sidebar-divider {
            border-color: #eee;
            margin: 10px 0;
        }
    </style>

    <nav class="navbar navbar-light align-items-start p-0 h-100">
        <ul class="navbar-nav w-100 flex-column pt-3">
            <li class="nav-item">
                <!-- Check URL segment to set active class -->
                <?php $uri = service('uri'); ?>
                <a class="nav-link admin-sidebar-link <?= ($uri->getSegment(2) == 'dashboard') ? 'active-link' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link admin-sidebar-link <?= ($uri->getSegment(2) == 'events') ? 'active-link' : '' ?>" href="<?= base_url('admin/events') ?>">
                    <i class="fas fa-calendar-alt"></i> Manage Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link admin-sidebar-link <?= ($uri->getSegment(2) == 'participants') ? 'active-link' : '' ?>" href="<?= base_url('admin/participants') ?>">
                    <i class="fas fa-users"></i> Participants
                </a>
            </li>
            
            <hr class="sidebar-divider">
            
            <li class="nav-item mt-auto">
                <a class="nav-link admin-sidebar-link text-danger" href="<?= base_url('/') ?>">
                    <i class="fas fa-external-link-alt"></i> Back to Site
                </a>
            </li>
        </ul>
    </nav>
</aside>
