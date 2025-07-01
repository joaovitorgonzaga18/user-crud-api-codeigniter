<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table         = 'users';
    protected $returnType    = \App\Entities\User::class;
    protected $useTimestamps = true;
    
    protected $allowedFields = [
        'name', 
        'email', 
        'password', 
        'access_level'
    ];

    protected $validationRules = [
        'name'  => 'required|max_length[255]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/]',
        'access_level' => 'required'
    ];

    protected $useSoftDeletes = true;

}
