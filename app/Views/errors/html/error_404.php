<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <style>
        body { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color: #333; background: #fff; margin: 0; padding: 40px; text-align: center; }
        .container { max-width: 600px; margin: 0 auto; }
        h1 { font-weight: normal; font-size: 36px; margin-bottom: 20px; color: #333; }
        p { font-size: 18px; line-height: 1.5; color: #666; margin-bottom: 30px; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .code { font-size: 100px; font-weight: bold; color: #eee; margin-bottom: -50px; z-index: -1; position: relative; }
    </style>
</head>
<body>
    <div class="container">
        <div class="code">404</div>
        <h1>Page Not Found</h1>
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                Sorry! Cannot seem to find the page you were looking for.
            <?php endif ?>
        </p>
        <p><a href="<?= base_url() ?>">Return to Homepage</a></p>
    </div>
</body>
</html>
