ERROR - <?= date('Y-m-d H:i:s') ?> --> <?= esc($title ?? 'Error') ?>

<?= esc($message ?? 'An error occurred.') ?>

<?php if (isset($statusCode)): ?>
Status Code: <?= esc($statusCode) ?>

<?php endif ?>
