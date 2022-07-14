<?php

namespace Modules\Medical\Models;

use CodeIgniter\Model;

class Employee extends Model
{
    protected $table = 'medical_employees';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'employee_full_name',
        'employee_email',
        'employee_phone',
        'employee_aadhar_number',
        'employee_sex',
        'employee_marital_status',
        'employee_date_of_birth',
        'employee_religion',
        'employee_address',
        'employee_tel_number',
        'employee_education',
        'employee_occupation',
        'created_by',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
