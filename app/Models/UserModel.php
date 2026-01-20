<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password', 'phone'];
    protected $returnType = 'array';

    /**
     * Get user by email
     */
    public function getByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Register new user
     */
    public function register($name, $email, $password, $phone = '')
    {
        if ($this->getByEmail($email)) {
            return false;
        }
        
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        
        return $this->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hashed,
            'phone' => $phone
        ]);
    }

    /**
     * Verify user credentials
     */
    public function verifyCredentials($email, $password)
    {
        $user = $this->getByEmail($email);
        
        if (!$user) {
            return false;
        }
        
        return password_verify($password, $user['password']);
    }

    /**
     * Get all users
     */
    public function getAll()
    {
        return $this->findAll();
    }
}
