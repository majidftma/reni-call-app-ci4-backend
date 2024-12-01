<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'language_code'];
    protected $returnType = 'array';
}
