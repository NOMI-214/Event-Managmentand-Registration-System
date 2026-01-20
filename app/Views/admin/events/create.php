<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="py-4">
    <h1 class="mb-4"><i class="fas fa-plus-circle text-primary"></i> Create New Event</h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="post" action="<?= base_url('admin/events/store') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="title" class="form-label">Event Title *</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                value="<?= old('title') ?>" required placeholder="Enter event title">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" id="description" name="description" rows="5" 
                                required placeholder="Enter event description"><?= old('description') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Event Date *</label>
                                <input type="date" class="form-control" id="date" name="date" 
                                    value="<?= old('date') ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Event Time *</label>
                                <input type="time" class="form-control" id="time" name="time" 
                                    value="<?= old('time') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location *</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                value="<?= old('location') ?>" required placeholder="Enter event location">
                        </div>

                        <div class="mb-4">
                            <label for="max_participants" class="form-label">Maximum Participants *</label>
                            <input type="number" class="form-control" id="max_participants" name="max_participants" 
                                value="<?= old('max_participants') ?>" required min="1" placeholder="Enter maximum participants">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Create Event
                            </button>
                            <a href="<?= base_url('admin/events') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h5 class="card-title mb-3">Event Tips</h5>
                    <ul class="mb-0">
                        <li>Use clear and descriptive titles</li>
                        <li>Write detailed descriptions about the event</li>
                        <li>Set realistic participant limits</li>
                        <li>Verify venue information before creating</li>
                        <li>Events require minimum 10 character description</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
