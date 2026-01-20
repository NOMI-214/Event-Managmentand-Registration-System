<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserAuth extends BaseController
{
    protected $userModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->userModel = model(UserModel::class);
    }

    /**
     * Show registration form
     */
    public function register()
    {
        echo view('auth/register');
    }

    /**
     * Handle user registration
     */
    public function storeRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . base_url('register'));
            exit;
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $phone = $_POST['phone'] ?? '';

        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'All fields are required';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? base_url('register')));
            exit;
        }

        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? base_url('register')));
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? base_url('register')));
            exit;
        }

        // Check if email exists
        if ($this->userModel->getByEmail($email)) {
            $_SESSION['error'] = 'Email already registered';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? base_url('register')));
            exit;
        }

        // Register user
        if ($this->userModel->register($name, $email, $password, $phone)) {
            $_SESSION['success'] = 'Registration successful! Please login.';
            header('Location: ' . base_url('login'));
            exit;
        } else {
            $_SESSION['error'] = 'Registration failed. Please try again.';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? base_url('register')));
            exit;
        }
    }

    /**
     * Show user login form
     */
    public function login()
    {
        // If already logged in, redirect to events
        if (session()->has('user_id')) {
            header('Location: ' . base_url('/'));
            exit;
        }

        echo view('auth/login');
    }

    /**
     * Handle user login
     */
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . base_url('login'));
            exit;
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->userModel->verifyCredentials($email, $password)) {
            $user = $this->userModel->getByEmail($email);
            
            if ($user) {
                session()->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'logged_in' => true,
                ]);
                
                header('Location: ' . base_url('/'));
                exit;
            }
        }
        
        // Failed login
        $_SESSION['error'] = 'Invalid email or password';
        $_SESSION['_old_input'] = $_POST;
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? base_url('login')));
        exit;
    }

    /**
     * Handle user logout
     */
    public function logout()
    {
        session()->destroy();
        header('Location: ' . base_url('login'));
        exit;
    }

    /**
     * Show user dashboard with registered events
     */
    public function dashboard()
    {
        if (!session()->has('user_id')) {
            header('Location: ' . base_url('login'));
            exit;
        }

        // Get user's registrations
        $userEmail = session()->get('user_email');
        $events = $this->getUserRegistrations($userEmail);
        
        $data = [
            'title' => 'My Dashboard',
            'events' => $events,
            'user' => [
                'name' => session()->get('user_name'),
                'email' => $userEmail,
            ]
        ];

        echo view('user/dashboard', $data);
    }

    /**
     * Get user's event registrations by email
     */
    protected function getUserRegistrations($userEmail)
    {
        $db = \Config\Database::connect();
        
        return $db->table('events e')
            ->select('e.*, r.registered_at')
            ->join('registrations r', 'e.id = r.event_id')
            ->where('r.email', $userEmail)
            ->orderBy('e.date', 'DESC')
            ->get()
            ->getResultArray();
    }
}
