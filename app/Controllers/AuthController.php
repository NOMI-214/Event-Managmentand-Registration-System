<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        log_message('info', 'AuthController::login() page accessed');
        return view('auth/login');
    }
    
    public function loginProcess()
    {
        try {
            log_message('info', 'AuthController::loginProcess() called');
            
            $userModel = new UserModel();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $user = $userModel->where('email', $email)->first();
            
            if (!$user || !password_verify($password, $user['password'])) {
                log_message('warning', 'Login failed for email: ' . $email);
                session()->setFlashdata('error', 'Invalid email or password');
                return redirect()->back();
            }
            
            session()->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email']
            ]);
            
            log_message('info', 'User logged in: ' . $user['email']);
            session()->setFlashdata('success', 'Login successful');
            return redirect()->to('dashboard');
        } catch (\Exception $e) {
            log_message('error', 'AuthController::loginProcess Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Login failed');
            return redirect()->back();
        }
    }
    
    public function register()
    {
        log_message('info', 'AuthController::register() page accessed');
        return view('auth/register');
    }
    
    public function registerProcess()
    {
        try {
            log_message('info', 'AuthController::registerProcess() called');
            
            $userModel = new UserModel();
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            if ($userModel->where('email', $email)->first()) {
                log_message('warning', 'Registration failed: Email exists - ' . $email);
                session()->setFlashdata('error', 'Email already exists');
                return redirect()->back();
            }
            
            $userModel->insert([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            log_message('info', 'New user registered: ' . $email);
            session()->setFlashdata('success', 'Registration successful. Please login.');
            return redirect()->to('login');
        } catch (\Exception $e) {
            log_message('error', 'AuthController::registerProcess Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Registration failed');
            return redirect()->back();
        }
    }
    
    public function logout()
    {
        $user = session()->get('user_email');
        log_message('info', 'User logged out: ' . $user);
        
        session()->destroy();
        session()->setFlashdata('success', 'Logged out successfully');
        return redirect()->to('/');
    }
}
