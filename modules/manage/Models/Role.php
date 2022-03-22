<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
  protected $table = 'roles';
  protected $returnType = 'object';
  protected $useSoftDeletes = true;

  protected $allowedFields = [
    'role_name',
    'role_display_name',
    'role_description',
  ];
  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  public function addPermissions($role_id, $permissions)
  {
    $data['role_id'] = $role_id;
    if (is_array($permissions)) {
      foreach ($permissions as $permission) {
        $data['permission_id'] = $permission;
        $this->addPermission($data);
      }
    } else {
      $data['permission_id'] = $permissions;
      $this->addPermission($data);
    }

    return 1;
  }

  /**
   * Insert permission.
   *
   * @param $data
   *
   * @return mixed
   */
  public function addPermission($data)
  {
    $db = db_connect();

    return $db->table('permission_roles')->insert($data);
  }

  /**
   * Edit permissions.
   *
   * @param $role_id
   * @param $permissions
   *
   * @return int
   */
  public function editPermissions($role_id, $permissions)
  {
    if ($this->deletePermissions($role_id, $permissions)) {
      $this->addPermissions($role_id, $permissions);
    }

    return 1;
  }

  /**
   * Delete permission.
   *
   * @param $role_id
   * @param $permissions
   *
   * @return mixed
   */
  public function deletePermissions($role_id, $permissions)
  {
    $db = db_connect();

    $sql = "delete from permission_roles where role_id= $role_id";

    return $query = $db->query($sql);
  }

  /**
   * Read role wise permissions.
   *
   * @param $id
   *
   * @return array
   */
  public function roleWisePermissions($id)
  {
    $db = db_connect();

    $sql = "select * from permission_roles where role_id= $id";
    $query = $db->query($sql);

    return array_map(function ($item) {
      return $item['permission_id'];
    }, $query->getResultArray());
  }
}
