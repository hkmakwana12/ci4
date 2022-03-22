<?php

namespace Modules\Blog\Controllers;

use App\Controllers\BaseController;

class BlogController extends BaseController
{
    public function index()
    {
        echo "Blog";
    }
    public function list()
    {
        echo "Blog list";
    }
}
