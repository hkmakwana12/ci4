<?php

use App\Libraries\Acl;

/*
 * Auth Helper
 *
 * @author       Hitesh Makwana <hkmakwana1212@gmail.com>
 * @purpose      Auth Helper
 */

if (!function_exists('can')) {
    /**
     * Check if current user has a permission by its name.
     *
     * @param $permissions
     *
     * @return bool
     */
    function can($permissions)
    {
        $acl = new Acl();

        return $acl->can($permissions);
    }
}
