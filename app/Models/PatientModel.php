<?php
namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patient_tbl'; // Table name
    protected $primaryKey = 'PatientID'; // Primary key column

    protected $useAutoIncrement = true; // Automatically increment primary key
    protected $returnType = 'object'; // Return results as objects
    protected $useSoftDeletes = false; // Soft delete is disabled

    protected $allowedFields = [
        'Lastname',
        'Firstname',
        'Middlename',
        'region',
        'province',
        'municipality',
        'barangay',
        'Sex',
        'ContactNumber',
        'CivilStatus',
        'Religion',
        'DateofBirth',
        'PlaceofBirth',
        'Occupation',
        'PatientStatus',
        'HostipalCaseNo',
        'PhysicianID',
        'created_at',
        'updated_at'
    ];

    // Enable automatic timestamps for created_at and updated_at
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get combined patient data from both tables (patient_tbl and patientdetails_tbl)
     * 
     * @param string $status
     * @return object
     */
    public function getPatientWithDetailsByStatus($status)
    {
        return $this->select('patient_tbl.*, patientdetails_tbl.HeadofFamily, patientdetails_tbl.AdultHistory, 
                             patientdetails_tbl.PediatricHistory, patientdetails_tbl.ChiefComplaint, 
                             patientdetails_tbl.InitialDiagnosis, patientdetails_tbl.Treatment, 
                             patientdetails_tbl.Bp, patientdetails_tbl.T, patientdetails_tbl.CR, 
                             patientdetails_tbl.RR, patientdetails_tbl.O2Sat, patientdetails_tbl.Wt, 
                             patientdetails_tbl.Ht, patientdetails_tbl.Medication, patientdetails_tbl.LaboratoryFindings, 
                             patientdetails_tbl.FinalDiagnosis, patientdetails_tbl.Disposition, patientdetails_tbl.DischargedDate')
            ->join('patientdetails_tbl', 'patient_tbl.PatientID = patientdetails_tbl.PatientID', 'left')
            ->where('patient_tbl.PatientStatus', $status)
            ->findAll(); // Return all results
    }
}

