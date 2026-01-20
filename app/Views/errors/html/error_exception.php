<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Type: <?= esc($title ?? 'Error') ?></title>
    <style>
        body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #333; background-color: #fcfcfc; margin: 0; padding: 0; }
        h1 { font-weight: normal; font-size: 24px; color: #900; margin: 0 0 10px 0; }
        .container { background: #fff; margin: 20px auto; padding: 20px; border: 1px solid #ccc; width: 90%; max-width: 1024px; box-shadow: 0 0 8px #d0d0d0; }
        .message { font-size: 16px; margin-bottom: 20px; }
        .source { background: #333; color: #fff; padding: 10px; overflow: auto; margin-bottom: 20px; border-radius: 4px; }
        .source code { font-family: Consolas, Monaco, Courier, monospace; font-size: 12px; }
        .trace { background: #fafafa; padding: 10px; border: 1px solid #e0e0e0; }
        .trace-row { padding: 5px 0; border-bottom: 1px solid #eee; font-family: Consolas, Monaco, Courier, monospace; font-size: 12px; }
        .file-path { color: #555; }
        .function { font-weight: bold; color: #007bff; }
        .header { background: #f8f9fa; border-bottom: 1px solid #dee2e6; padding: 15px; margin-bottom: 20px; }
        .footer { font-size: 11px; color: #777; margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?= esc($title ?? 'Exception Occurred') ?></h1>
            <div class="message">
                <?= esc($type ?? get_class($exception)) ?>: 
                <strong><?= esc($message ?? $exception->getMessage()) ?></strong>
            </div>
            <p class="file-path">
                in <?= esc($file ?? $exception->getFile()) ?> 
                on line <?= esc($line ?? $exception->getLine()) ?>
            </p>
        </div>

        <?php if (! empty($trace)) : ?>
            <h3>Stack Trace</h3>
            <div class="trace">
                <?php foreach ($trace as $index => $row) : ?>
                    <div class="trace-row">
                        #<?= $index ?> 
                        <span class="file-path"><?= esc($row['file'] ?? '') ?></span>
                        (<?= esc($row['line'] ?? '') ?>): 
                        <span class="function">
                            <?= esc($row['class'] ?? '') ?><?= esc($row['type'] ?? '') ?><?= esc($row['function'] ?? '') ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="footer">
            CodeIgniter v<?= CodeIgniter\CodeIgniter::CI_VERSION ?>
        </div>
    </div>
</body>
</html>
