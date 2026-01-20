<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1><i class="fas fa-users text-primary"></i> <?= htmlspecialchars($event['title']) ?></h1>
            <p class="text-muted">
                <i class="fas fa-calendar"></i> <?= date('F d, Y', strtotime($event['date'])) ?> at <?= $event['time'] ?>
            </p>
        </div>
        <div class="btn-group" role="group">
            <a href="<?= base_url('admin/participants/export/csv/' . $event['id']) ?>" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> CSV
            </a>
            <a href="<?= base_url('admin/participants/export/excel/' . $event['id']) ?>" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> Excel
            </a>
            <a href="<?= base_url('admin/participants/export/pdf/' . $event['id']) ?>" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> PDF
            </a>
        </div>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> 
        <strong>Total Participants:</strong> <?= count($registrations) ?> / <?= $event['max_participants'] ?>
    </div>

    <?php if (!empty($registrations)): ?>
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($registrations as $reg): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><strong><?= htmlspecialchars($reg['name']) ?></strong></td>
                                <td><?= htmlspecialchars($reg['email']) ?></td>
                                <td><?= htmlspecialchars($reg['phone']) ?></td>
                                <td>
                                    <small class="text-muted">
                                        <?= date('M d, Y H:i', strtotime($reg['registered_at'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/participants/delete/' . $reg['id']) ?>" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure?');">
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
        <div class="alert alert-warning text-center py-5">
            <i class="fas fa-info-circle fa-3x mb-3 d-block"></i>
            <h5>No participants registered yet</h5>
            <p class="mb-0">Registrations will appear here as users register.</p>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?= base_url('admin/events') ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Events
        </a>
    </div>
</div>

<?= $this->endSection() ?>
