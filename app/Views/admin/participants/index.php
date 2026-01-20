<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-users text-primary"></i> All Participants</h1>
        <div class="btn-group" role="group">
            <a href="<?= base_url('admin/participants/export/csv') ?>" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> CSV
            </a>
            <a href="<?= base_url('admin/participants/export/excel') ?>" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> Excel
            </a>
            <a href="<?= base_url('admin/participants/export/pdf') ?>" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> PDF
            </a>
        </div>
    </div>

    <!-- Filter by Event -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="get" class="row g-2">
                <div class="col-md-6">
                    <select class="form-select" name="event_id" id="eventFilter" onchange="this.form.submit()">
                        <option value="">All Events</option>
                        <?php foreach ($events as $evt): ?>
                            <option value="<?= $evt['id'] ?>">
                                <?= htmlspecialchars($evt['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($registrations)): ?>
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Event</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrations as $reg): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($reg['name']) ?></strong></td>
                                <td><?= htmlspecialchars($reg['email']) ?></td>
                                <td><?= htmlspecialchars($reg['phone']) ?></td>
                                <td><?= htmlspecialchars($reg['event_title']) ?></td>
                                <td>
                                    <small class="text-muted">
                                        <?= date('M d, Y', strtotime($reg['registered_at'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/participants/delete/' . $reg['id']) ?>" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this participant?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-users fa-3x mb-3 d-block"></i>
            <h5>No participants yet</h5>
            <p class="mb-0">Registrations will appear here as users register for events.</p>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
