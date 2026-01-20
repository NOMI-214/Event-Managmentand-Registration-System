<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
        ];

        // Simply replace if exists or insert
        $this->db->table('admin')->replace($data);
    }
}
