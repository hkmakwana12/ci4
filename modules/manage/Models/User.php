<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
  protected $table = 'users';
  protected $returnType = 'object';
  protected $useSoftDeletes = true;

  protected $allowedFields = [
    'user_firstname',
    'user_lastname',
    'user_profile',
    'user_email',
    'user_phone',
    'email_verification_code',
    'is_email_verify',
    'is_active',
    'profile_picture',
    'password',
    'last_login',
    'last_logout',
    'last_accessed_ip',
    'logins',
  ];
  protected $useTimestamps = true;
  protected $createdField = 'created_at';
  protected $updatedField = 'updated_at';
  protected $deletedField = 'deleted_at';

  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  protected function beforeInsert(array $data)
  {
    $data = $this->passwordHash($data);

    return $data;
  }

  protected function beforeUpdate(array $data)
  {
    $data = $this->passwordHash($data);

    return $data;
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['password'])) {
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
    }

    return $data;
  }

  /**
   * Insert roles.
   *
   * @param $user_id
   * @param $roles
   *
   * @return int
   */
  public function addRoles($user_id, $roles)
  {
    $data['user_id'] = $user_id;
    if (is_array($roles)) {
      foreach ($roles as $role) {
        $data['role_id'] = $role;
        $this->addRole($data);
      }
    } else {
      $data['role_id'] = $roles;
      $this->addRole($data);
    }

    return 1;
  }

  /**
   * Insert role.
   *
   * @param $data
   *
   * @return mixed
   */
  public function addRole($data)
  {
    $db = db_connect();

    return $db->table('roles_users')->insert($data);
  }

  /**
   * Edit roles.
   *
   * @param $user_id
   * @param $roles
   *
   * @return int
   */
  public function editRoles($user_id, $roles)
  {
    if ($this->deleteRoles($user_id, $roles)) {
      $this->addRoles($user_id, $roles);
    }

    return 1;
  }

  /**
   * Delete role.
   *
   * @param $user_id
   * @param $roles
   *
   * @return mixed
   */
  public function deleteRoles($user_id, $roles)
  {
    $db = db_connect();

    $sql = "delete from roles_users where user_id= $user_id";

    return $query = $db->query($sql);
  }

  /**
   * Find roles associated with user.
   *
   * @param $id
   *
   * @return array
   */
  public function userWiseRoles($id)
  {
    $db = db_connect();

    $sql = "select * from roles_users where user_id= $id";
    $query = $db->query($sql);

    return array_map(function ($item) {
      return $item['role_id'];
    }, $query->getResultArray());
  }
  public function saveMeta($data, $user_id)
  {
    $db = db_connect();
    // $db->table('user_meta')->where('user_id', $user_id)->delete();
    $remove = ['ci_csrf_token', 'id', 'user_firstname', 'user_lastname', 'user_profile', 'user_email', 'user_phone', 'password', 'confirm_password',
    'old_user_profile','email_verification_code','is_email_verify','is_active','profile_picture','last_login','last_logout','last_accessed_ip','logins'];

    foreach ($remove as $key) {
      unset($data[$key]);
    }

    foreach ($data as $key => $row) {
      $db->table('user_meta')->where('user_id', $user_id)->where('meta_key', $key)->delete();
      $insertData = array(
        'user_id' => $user_id,
        'meta_key' => $key,
        'meta_value' => $row
      );
      $db->table('user_meta')->insert($insertData);
    }
  }
  public function getMeta($user_id)
  {
    $db = db_connect();

    $sql = "select * from user_meta where user_id= $user_id";
    $query = $db->query($sql);

    $resultarr = array();
    foreach ($query->getResultArray() as $key => $value) {
      $resultarr[$value['meta_key']] = $value['meta_value'];
    }
    return (object)$resultarr;
  }
}
