<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicationModel extends Model
{
    protected $table = "medication_tbl";
    protected $primaryKey = "MedicationID";
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ["MedicationName", "Dosage", "MedicationID"];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
