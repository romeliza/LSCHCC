<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientDetailsModel extends Model
{
    protected $table = 'patientdetails_tbl'; // Table name
    protected $primaryKey = 'PatientDetailsID'; // Primary key of the table

    protected $useAutoIncrement = true; // Automatically increment primary key
    protected $returnType = 'object'; // Return results as objects (can change to 'array' if needed)
    protected $useSoftDeletes = false; // Soft delete is disabled

    protected $allowedFields = [
        'PatientID', // Foreign Key linking to Patient Table
        'HeadofFamily',
        'AdultHistory',
        'PediatricHistory',
        'PatientDateTime',
        'ChiefComplaint',
        'InitialDiagnosis',
        'Treatment',
        'Bp',
        'T',
        'CR',
        'RR',
        'O2Sat',
        'Wt',
        'Ht',
        'Medication',
        'LaboratoryFindings',
        'FinalDiagnosis',
        'Disposition',
        'DischargedDate',
    ]; // Fields that can be inserted or updated
}

