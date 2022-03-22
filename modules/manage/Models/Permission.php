<?php

namespace Modules\Manage\Models;

use CodeIgniter\Model;

class Permission extends Model
{
  protected $table = 'permissions';
  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'permission_name',
    'permission_display_name',
    'permission_description',
  ];
  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';
}
