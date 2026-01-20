<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['username', 'password'];
    protected $returnType = 'array';

    /**
     * Get admin by username
     */
    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Verify admin credentials
     */
    public function verifyCredentials($username, $password)
    {
        $admin = $this->getByUsername($username);
        
        if (!$admin) {
            return false;
        }
        
        return password_verify($password, $admin['password']);
    }

    /**
     * Create new admin with hashed password
     */
    public function createAdmin($username, $password)
    {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        
        return $this->insert([
            'username' => $username,
            'password' => $hashed
        ]);
    }
}
