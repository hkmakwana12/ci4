<?php

/**
 * Permission Routes
 */
$routes->group("admin/permissions", ["namespace" => "\Modules\Manage\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'PermissionController::index', ['as' => 'admin.permissions']);
    $routes->get('list', 'PermissionController::list', ['as' => 'admin.permissions.list']);
    $routes->match(['get', 'post'], 'create', 'PermissionController::create', ['as' => 'admin.permissions.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'PermissionController::edit/$1', ['as' => 'admin.permissions.edit']);
    $routes->post('delete', 'PermissionController::delete', ['as' => 'admin.permissions.delete']);
});

/**
 * Role Routes
 */
$routes->group("admin/roles", ["namespace" => "\Modules\Manage\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'RoleController::index', ['as' => 'admin.roles']);
    $routes->get('list', 'RoleController::list', ['as' => 'admin.roles.list']);
    $routes->match(['get', 'post'], 'create', 'RoleController::create', ['as' => 'admin.roles.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'RoleController::edit/$1', ['as' => 'admin.roles.edit']);
    $routes->post('delete', 'RoleController::delete', ['as' => 'admin.roles.delete']);
});


/**
 * User Routes
 */
$routes->group("admin/users", ["namespace" => "\Modules\Manage\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'UserController::index', ['as' => 'admin.users']);
    $routes->get('list', 'UserController::list', ['as' => 'admin.users.list']);
    $routes->match(['get', 'post'], 'create', 'UserController::create', ['as' => 'admin.users.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'UserController::edit/$1', ['as' => 'admin.users.edit']);
    $routes->post('delete', 'UserController::delete', ['as' => 'admin.users.delete']);


    $routes->get('impersonate/(:num)', 'UserController::impersonate/$1', ['as' => 'admin.users.impersonate']);
});
