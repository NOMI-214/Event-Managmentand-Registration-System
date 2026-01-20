<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        echo view('admin/login');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . base_url('admin/login'));
            exit;
        }

        $adminModel = model(\App\Models\AdminModel::class);
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($adminModel->verifyCredentials($username, $password)) {
            $admin = $adminModel->getByUsername($username);
            
            if ($admin) {
                session()->set([
                    'admin_id' => $admin['id'],
                    'admin_username' => $admin['username'],
                    'logged_in' => true,
                ]);
                
                header('Location: ' . base_url('admin/dashboard'));
                exit;
            }
        }
        
        // Failed login
        $_SESSION['error'] = 'Invalid username or password';
        $_SESSION['_old_input'] = $_POST;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('admin/login')
            ->with('success', 'Logged out successfully');
    }
}
