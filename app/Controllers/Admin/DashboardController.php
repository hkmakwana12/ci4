<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use CodeIgniter\Controller;

class DashboardController extends AdminController
{
    public function index()
    {
        $session = session();

        return view('admin/dashboard');
    }
}
