<?php

namespace Modules\Doctor\Models;

use CodeIgniter\Model;

class Screening extends Model
{
    protected $table = 'screenings';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'screening_name',
        'is_active',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
