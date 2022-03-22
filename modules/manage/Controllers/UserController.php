<?php

namespace Modules\Manage\Controllers;

use App\Controllers\AdminController;

class UserController extends AdminController
{
    public function index()
    {
        echo "User " . $this->data['test_name'];
    }
    public function list()
    {
        echo "User list";
    }
}
