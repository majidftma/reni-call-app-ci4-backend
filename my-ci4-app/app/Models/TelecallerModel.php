<?php
namespace App\Models;

use CodeIgniter\Model;

class TelecallerModel extends Model
{
    protected $table = 'telecallers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['mobile', 'name', 'gender', 'accountnumber', 'ifsc', 'preferred_language','user_id'];
}

