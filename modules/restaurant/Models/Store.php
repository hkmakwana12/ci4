<?php

namespace Modules\Restaurant\Models;

use CodeIgniter\Model;

class Store extends Model
{
    protected $table = 'stores';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'store_name',
        'is_active',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
