<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-calendar-alt text-primary"></i> Manage Events</h1>
        <a href="<?= base_url('admin/events/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Event
        </a>
    </div>

    <?php if (!empty($events)): ?>
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Event Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th>Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($event['title']) ?></strong>
                                </td>
                                <td><?= date('F d, Y', strtotime($event['date'])) ?></td>
                                <td><?= $event['time'] ?></td>
                                <td><?= htmlspecialchars($event['location']) ?></td>
                                <td><?= $event['max_participants'] ?> seats</td>
                                <td>
                                    <a href="<?= base_url('admin/events/edit/' . $event['id']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/participants/event/' . $event['id']) ?>" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-users"></i> Participants
                                    </a>
                                    <a href="<?= base_url('admin/events/delete/' . $event['id']) ?>" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this event?');">
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
            <i class="fas fa-calendar-plus fa-3x mb-3 d-block"></i>
            <h5>No events created yet</h5>
            <p>
                <a href="<?= base_url('admin/events/create') ?>" class="btn btn-primary mt-2">
                    <i class="fas fa-plus"></i> Create First Event
                </a>
            </p>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
