<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Error') ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #667eea;
            font-size: 72px;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        a:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= esc($statusCode ?? '500') ?></h1>
        <h2><?= esc($title ?? 'Whoops!') ?></h2>
        <p><?= esc($message ?? 'We seem to have hit a snag. Please try again later.') ?></p>
        <a href="<?= base_url() ?>">Go to Homepage</a>
    </div>
</body>
</html>
