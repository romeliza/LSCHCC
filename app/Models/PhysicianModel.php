<?php

namespace App\Models;

use CodeIgniter\Model;

class PhysicianModel extends Model
{
    protected $table      = 'physician_tbl';  // Table name
    protected $primaryKey = 'PhysicianID';     // Primary key of the table

    protected $useAutoIncrement = true;        // Automatically increment primary key
    protected $returnType     = 'object';       // Return results as an array
    protected $useSoftDeletes = false;         // Soft delete is disabled (set to true if you want soft deletes)

    protected $allowedFields = [
        'Lastname', 
        'Firstname', 
        'Middlename', 
        'ContactNumber', 
        'Specialization', 
        'Email', 
        'created_at'
    ]; // Fields that can be updated/inserted
    
    // Validation rules (optional)
    protected $validationRules = [
        'Lastname'     => 'required|max_length[150]',
        'Firstname'    => 'required|max_length[150]',
        'Middlename'   => 'max_length[150]',
        'ContactNumber' => 'max_length[15]',
        'Specialization' => 'max_length[150]',
        'Email'        => 'required|valid_email|max_length[150]',
        'created_at'   => 'valid_date'
    ];

    protected $validationMessages = []; // Customize error messages (optional)
    protected $skipValidation     = false; // Set to true if validation is not required
}
