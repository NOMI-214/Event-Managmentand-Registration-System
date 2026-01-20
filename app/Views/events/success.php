<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmed | UET Mardan Event System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }
        
        .confirmation-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .ticket-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 600px;
            position: relative;
        }
        
        .ticket-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: white;
            color: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .ticket-body {
            padding: 40px 30px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 15px;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #888;
            font-size: 0.95rem;
        }
        
        .detail-value {
            font-weight: 600;
            color: #333;
            text-align: right;
        }
        
        .qr-placeholder {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #ddd;
        }
        
        .ticket-footer {
            background: #f1f5f9;
            padding: 20px 30px;
            text-align: center;
        }
        
        @media print {
            .btn-group-action { display: none; }
            body { background: white; }
            .ticket-card { box-shadow: none; border: 2px solid #333; }
        }
    </style>
</head>
<body>

    <div class="confirmation-container">
        <div class="ticket-card">
            <div class="ticket-header">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2>Registration Confirmed!</h2>
                <p class="mb-0 opacity-75">Thank you for registering. Here is your ticket.</p>
            </div>
            
            <div class="ticket-body">
                <div class="detail-row">
                    <div class="detail-label">Event</div>
                    <div class="detail-value"><?= htmlspecialchars($event['title']) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Attendee Name</div>
                    <div class="detail-value"><?= htmlspecialchars($registration['name']) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Registration ID</div>
                    <div class="detail-value">#<?= str_pad($registration['id'], 6, '0', STR_PAD_LEFT) ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Date & Time</div>
                    <div class="detail-value">
                        <?= date('M d, Y', strtotime($event['date'])) ?><br>
                        <?= $event['time'] ?>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Location</div>
                    <div class="detail-value"><?= htmlspecialchars($event['location']) ?></div>
                </div>

                <div class="qr-placeholder">
                    <i class="fas fa-qrcode fa-4x text-dark mb-2"></i>
                    <p class="small mb-0 text-muted">Scan at entrance</p>
                </div>
            </div>

            <div class="ticket-footer btn-group-action">
                <div class="d-grid gap-2">
                    <button onclick="window.print()" class="btn btn-outline-dark btn-lg">
                        <i class="fas fa-print"></i> Print Ticket
                    </button>
                    <a href="<?= base_url('events') ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-arrow-left"></i> Back to Events
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
