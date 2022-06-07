<?php

namespace Modules\Restaurant\Models;

use CodeIgniter\Model;

class Table extends Model
{
    protected $table = 'tables';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'store_id',
        'table_number',
        'table_name',
        'table_description',
        'table_capacity',
        'is_running',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
