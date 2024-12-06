<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user_tbl';
    protected $primaryKey = 'UserID';

    protected $returnType     = 'object'; // Ensures it returns objects
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'LastName',
        'FirstName',
        'MiddleName',
        'region',
        'municipality',
        'province',
        'barangay',
        'Username',
        'Password',
        'PhoneNumber',
        'Role',
        'Status',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'Created_at';
    protected $updatedField  = 'Updated_at';
    protected $deletedField  = 'Deleted_at';

    // Method to toggle status between 1 and 0
    public function toggleStatus($userID)
    {
        $currentStatus = $this->where($this->primaryKey, $userID)->first()->Status;
        $newStatus = $currentStatus == 1 ? 0 : 1;
        return $this->update($userID, ['Status' => $newStatus]);
    }
}
