<?php

namespace Modules\Restaurant\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'store_id',
        'category_name',
        'is_active',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
