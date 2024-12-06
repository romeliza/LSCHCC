<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table      = 'activity_logs';
    protected $primaryKey = 'ActivityLogsID';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'UserID',    
        'activity',  
        'created_at' 
    ];
    protected $useTimestamps = false; 
    protected $createdField  = 'created_at'; 

  
}
