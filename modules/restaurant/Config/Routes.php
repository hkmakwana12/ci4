<?php

/**
 * Store Routes
 */
$routes->group("admin/stores", ["namespace" => "\Modules\Restaurant\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'StoreController::index', ['as' => 'admin.stores']);
    $routes->get('list', 'StoreController::list', ['as' => 'admin.stores.list']);
    $routes->match(['get', 'post'], 'create', 'StoreController::create', ['as' => 'admin.stores.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'StoreController::edit/$1', ['as' => 'admin.stores.edit']);
    $routes->post('delete', 'StoreController::delete', ['as' => 'admin.stores.delete']);
});

/**
 * Table Routes
 */
$routes->group("admin/tables", ["namespace" => "\Modules\Restaurant\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'TableController::index', ['as' => 'admin.tables']);
    $routes->get('list', 'TableController::list', ['as' => 'admin.tables.list']);
    $routes->match(['get', 'post'], 'create', 'TableController::create', ['as' => 'admin.tables.create']);
    $routes->match(['get', 'post'], 'edit/(:num)', 'TableController::edit/$1', ['as' => 'admin.tables.edit']);
    $routes->post('delete', 'TableController::delete', ['as' => 'admin.tables.delete']);
});
