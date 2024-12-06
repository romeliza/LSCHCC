<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicationStatusModel extends Model
{
    protected $table = 'medicationstatus_tbl';

    protected $primaryKey = "MedicationStatusID";
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ["PatientID","MedicationID", "MedicationIntakeID", "Remark", "Time", "Date", "IntakeStatus"];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
