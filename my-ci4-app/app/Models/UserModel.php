<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'mobile', 'dob', 'preferred_language', 'last_login'];
    protected $returnType = 'array';
}
