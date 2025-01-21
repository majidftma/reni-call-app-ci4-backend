<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'created_at'];
}
