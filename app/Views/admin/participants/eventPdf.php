<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Participants Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #667eea; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        tr:hover { background-color: #f5f5f5; }
        .info { background-color: #f0f0f0; padding: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Event Participants Report</h1>
    <div class="info">
        <strong>Event:</strong> <?= htmlspecialchars($event['title']) ?><br>
        <strong>Date:</strong> <?= date('F d, Y', strtotime($event['date'])) ?><br>
        <strong>Time:</strong> <?= $event['time'] ?><br>
        <strong>Location:</strong> <?= htmlspecialchars($event['location']) ?><br>
        <strong>Report Generated:</strong> <?= date('F d, Y H:i:s') ?>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($registrations as $reg): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($reg['name']) ?></td>
                    <td><?= htmlspecialchars($reg['email']) ?></td>
                    <td><?= htmlspecialchars($reg['phone']) ?></td>
                    <td><?= date('M d, Y H:i', strtotime($reg['registered_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p style="margin-top: 30px; text-align: center; color: #999;">
        Total Participants: <?= count($registrations) ?> / <?= $event['max_participants'] ?>
    </p>
</body>
</html>
