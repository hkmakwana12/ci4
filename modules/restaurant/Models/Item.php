<?php

namespace Modules\Restaurant\Models;

use CodeIgniter\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'store_id',
        'category_id',
        'item_name',
        'item_description',
        'item_price',
        'is_active',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
