<?php

namespace App\Libraries;

use Modules\Manage\Models\User;

class Acl
{

    /**
     * Check if current user has a permission by its name.
     *
     * @param $permissions
     * @param bool $requireAll
     *
     * @return bool
     */
    public function can($permissions, $requireAll = false)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if ($this->checkPermission($permission) && !$requireAll) {
                    return true;
                } elseif (!$this->checkPermission($permission) && $requireAll) {
                    return false;
                }
            }
        } else {
            return $this->checkPermission($permissions);
        }
        // If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
        // If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
        // Return the value of $requireAll;
        return $requireAll;
    }

    /**
     * Check current user has specific permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function checkPermission($permission)
    {
        return in_array($permission, $this->userPermissions());
    }

    /**
     * Read current user permissions name.
     *
     * @return mixed
     */
    public function userPermissions()
    {
        $db = db_connect();

        $sql = 'select permissions.* from permissions inner join permission_roles on permissions.id = permission_roles.permission_id where permission_roles.role_id in ' . $this->roles() . ' and permissions.is_active = 1 group by permission_roles.permission_id';

        $query = $db->query($sql);

        return array_map(function ($item) {
            return $item['permission_name'];
        }, $query->getResultArray());
    }

    /**
     * Read authenticated user roles.
     *
     * @return array
     */
    public function roles()
    {
        $id = session()->get('id');

        $roles = (new User())->userWiseRoles($id);

        return '(' . implode(',', $roles) . ')';
    }
}
