An uncaught Exception was encountered

Type:        <?= get_class($exception) ?>
Message:     <?= $exception->getMessage() ?>
Filename:    <?= $exception->getFile() ?>
Line Number: <?= $exception->getLine() ?>

Backtrace:
<?php foreach ($trace as $error): ?>
<?php if (isset($error['file']) && strpos($error['file'], realpath(SYSTEMPATH)) !== 0): ?>
	File: <?= $error['file'] ?>
	Line: <?= $error['line'] ?>
	Function: <?= $error['function'] ?>
<?php endif ?>
<?php endforeach ?>
