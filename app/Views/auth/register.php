<?php
// app/Views/auth/register.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration | Event Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        
        .register-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h1 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .register-header p {
            color: #666;
            font-size: 14px;
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 14px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .back-link {
            text-align: center;
            margin-top: 10px;
        }
        
        .back-link a {
            color: #999;
            text-decoration: none;
            font-size: 13px;
        }
        
        .back-link a:hover {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1><i class="fas fa-user-plus"></i> Create Account</h1>
            <p>Join Event Management System</p>
        </div>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= session()->get('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('register') ?>">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    placeholder="Enter your full name"
                    value="<?= $_SESSION['_old_input']['name'] ?? '' ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email"
                    value="<?= $_SESSION['_old_input']['email'] ?? '' ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input 
                    type="tel" 
                    class="form-control" 
                    id="phone" 
                    name="phone" 
                    placeholder="Enter your phone number"
                    value="<?= $_SESSION['_old_input']['phone'] ?? '' ?>"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Enter password (min 6 characters)"
                    required
                >
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="confirm_password" 
                    name="confirm_password" 
                    placeholder="Confirm your password"
                    required
                >
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-check"></i> Register
            </button>
        </form>

        <div class="login-link">
            Already have an account? <a href="<?= base_url('login') ?>">Login here</a>
        </div>

        <div class="back-link">
            <a href="<?= base_url('/') ?>">← Back to Home</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
