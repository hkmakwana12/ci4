<?php

$routes->group("admin/permissions", ["namespace" => "\Modules\Manage\Controllers", "filter" => "auth"], function ($routes) {
    /*
    * Permission Controller
    */
    $routes->get('/', 'PermissionController::index', ['as' => 'admin.permissions']);
    $routes->get('list', 'PermissionController::list', ['as' => 'admin.permissions.list']);
    $routes->match(['get', 'post'], 'create', 'PermissionController::create', ['as' => 'admin.permissions.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'PermissionController::edit/$1', ['as' => 'admin.permissions.edit']);
    $routes->post('delete', 'PermissionController::delete', ['as' => 'admin.permissions.delete']);
});
