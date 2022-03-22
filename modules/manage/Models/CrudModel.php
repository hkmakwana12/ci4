<?php

namespace Modules\Manage\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{
    protected $table = 'user_table';

    protected $returnType = 'object';

    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'gender'];
}
