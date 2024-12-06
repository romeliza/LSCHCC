<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicationIntakeModel extends Model
{
    protected $table = "medicationintake_tbl";
    protected $primaryKey = "MedicationIntakeID";
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
 
    protected $allowedFields = ["MedicationID", "PatientID", "IntakeTimes", "MedicationStatus", "IntakeDates"];

    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}