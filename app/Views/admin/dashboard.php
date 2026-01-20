<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<style>
    .dashboard-header {
        margin-bottom: 30px;
    }
    
    .dashboard-card {
        border: none;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        color: white;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.15);
    }
    
    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.25);
    }
    
    .bg-gradient-purple { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .bg-gradient-blue { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .bg-gradient-green { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    
    .card-content {
        position: relative;
        z-index: 2;
        padding: 24px;
    }
    
    .card-icon-bg {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 8rem;
        opacity: 0.15;
        transform: rotate(-15deg);
        z-index: 1;
        transition: transform 0.3s;
    }
    
    .dashboard-card:hover .card-icon-bg {
        transform: rotate(0deg) scale(1.1);
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .section-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        background: white;
        height: 100%;
    }
    
    .section-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    
    .quick-action-btn {
        border-radius: 12px;
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: white;
        border: 2px solid #f0f0f0;
        color: #555;
        transition: all 0.2s;
        text-decoration: none;
        height: 100%;
        justify-content: center;
    }
    
    .quick-action-btn:hover {
        border-color: #667eea;
        background: #f8f9ff;
        color: #667eea;
        transform: translateY(-2px);
    }
    
    .quick-action-icon {
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: #667eea;
    }
    
    .table-custom thead th {
        background: #f8f9fa;
        color: #666;
        font-weight: 600;
        border-top: none;
    }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        background: #eff6ff;
        color: #667eea;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 12px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
</style>

<div class="py-4">
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1">Dashboard Overview</h2>
            <p class="text-muted mb-0">Welcome back, Admin!</p>
        </div>
        <div>
            <span class="text-muted me-2"><i class="fas fa-clock"></i> <?= date('F d, Y') ?></span>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="dashboard-card bg-gradient-purple">
                <div class="card-content">
                    <div class="stat-value"><?= $totalEvents ?></div>
                    <div class="stat-label">Total Events</div>
                </div>
                <i class="fas fa-calendar-alt card-icon-bg"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-gradient-green">
                <div class="card-content">
                    <div class="stat-value"><?= $totalRegistrations ?></div>
                    <div class="stat-label">Total Registrations</div>
                </div>
                <i class="fas fa-users card-icon-bg"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-gradient-blue">
                <div class="card-content">
                    <div class="stat-value"><?= $upcomingEvents ?></div>
                    <div class="stat-label">Upcoming Events</div>
                </div>
                <i class="fas fa-glass-cheers card-icon-bg"></i>
            </div>
        </div>
    </div>

    <!-- Recent Activity Row -->
    <div class="row g-4">
        <!-- Recent Events -->
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">
                    <h5 class="section-title"><i class="fas fa-calendar-check text-primary me-2"></i> Recent Events</h5>
                    <a href="<?= base_url('admin/events') ?>" class="btn btn-sm btn-outline-primary rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($recentEvents)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Event</th>
                                        <th>Date</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentEvents as $event): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                    <div>
                                                        <span class="d-block fw-bold"><?= htmlspecialchars(substr($event['title'], 0, 25)) ?></span>
                                                        <small class="text-muted"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars(substr($event['location'], 0, 20)) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= date('M d, Y', strtotime($event['date'])) ?></td>
                                            <td class="text-end pe-4">
                                                <a href="<?= base_url('admin/events/edit/' . $event['id']) ?>" class="btn btn-sm btn-light text-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted">No events found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Registrations -->
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">
                    <h5 class="section-title"><i class="fas fa-user-plus text-success me-2"></i> Recent Registrations</h5>
                    <a href="<?= base_url('admin/participants') ?>" class="btn btn-sm btn-outline-success rounded-pill">View All</a>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($recentRegistrations)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Participant</th>
                                        <th>Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentRegistrations as $reg): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle" style="background: #ecfdf5; color: #10b981;">
                                                        <?= strtoupper(substr($reg['name'], 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <span class="d-block fw-bold"><?= htmlspecialchars($reg['name']) ?></span>
                                                        <small class="text-muted"><?= htmlspecialchars($reg['email']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Fixed the index key from title to event_title -->
                                                <span class="badge bg-light text-dark border">
                                                    <?= htmlspecialchars(substr($reg['event_title'] ?? $reg['title'] ?? 'Unknown', 0, 20)) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted">No registrations found.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions Row -->
    <div class="row mt-5">
        <div class="col-12">
            <h5 class="fw-bold mb-3 ms-1">Quick Actions</h5>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <a href="<?= base_url('admin/events/create') ?>" class="quick-action-btn shadow-sm">
                <i class="fas fa-plus-circle quick-action-icon"></i>
                <span class="fw-bold">Create Event</span>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <a href="<?= base_url('admin/events') ?>" class="quick-action-btn shadow-sm">
                <i class="fas fa-list-alt quick-action-icon"></i>
                <span class="fw-bold">Manage Events</span>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <a href="<?= base_url('admin/participants') ?>" class="quick-action-btn shadow-sm">
                <i class="fas fa-users-cog quick-action-icon"></i>
                <span class="fw-bold">Participants</span>
            </a>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <a href="<?= base_url('admin/participants/export/csv') ?>" class="quick-action-btn shadow-sm">
                <i class="fas fa-file-csv quick-action-icon"></i>
                <span class="fw-bold">Export Report</span>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
