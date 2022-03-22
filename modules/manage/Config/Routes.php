<?php

$routes->group("users", ["namespace" => "\Modules\Manage\Controllers"], function ($routes) {

    $routes->get("/", "UserController::index");
    $routes->get("a", "UserController::list");
});


$routes->group("admin/permissions", ["namespace" => "\Modules\Manage\Controllers"], function ($routes) {
    /*
    * Permission Controller
    */
    $routes->get('/', 'PermissionController::index', ['as' => 'admin.permissions']);
    $routes->get('list', 'PermissionController::list', ['as' => 'admin.permissions.list']);
    $routes->match(['get', 'post'], 'create', 'PermissionController::create', ['as' => 'admin.permissions.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'PermissionController::edit/$1', ['as' => 'admin.permissions.edit']);
    $routes->post('delete', 'PermissionController::delete', ['as' => 'admin.permissions.delete']);
});
