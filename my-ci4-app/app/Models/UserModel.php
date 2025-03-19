<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'mobile', 'dob', 'preferred_language', 'last_login', 'online_status'];
    protected $returnType = 'array';

    // Function to update the online status
    public function updateOnlineStatus($userId, $status)
    {
        return $this->update($userId, ['online_status' => $status]);
    }
}
