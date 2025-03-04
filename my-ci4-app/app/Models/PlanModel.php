<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanModel extends Model
{
    protected $table = 'plans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_of_coins', 'amount', 'status'];
    protected $returnType = 'array';


    // Function to get only active plans
    public function getActivePlans()
    {
        return $this->where('status', 1)->findAll();
    }
}
