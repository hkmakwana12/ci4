<?php

namespace Modules\Medical\Models;

use CodeIgniter\Model;

class EmployeePersonalHistory extends Model
{
    protected $table = 'medical_employee_history';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'employee_id',
        'bcg_date',
        'je_date',
        'hepatitis_b_date',
        'vitamin_a_date',
        'opv_date',
        'dpt_date',
        'ipv_date',
        'tt_date',
        'mr_date',
        'rota_virus_date',
        'history_note',
        'created_by',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
