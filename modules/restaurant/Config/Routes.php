<?php

/**
 * Store Routes
 */
$routes->group("admin/stores", ["namespace" => "\Modules\Restaurant\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'StoreController::index', ['as' => 'admin.stores']);
    $routes->get('list', 'StoreController::list', ['as' => 'admin.stores.list']);
    $routes->match(['get', 'post'], 'create', 'StoreController::create', ['as' => 'admin.stores.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'StoreController::edit/$1', ['as' => 'admin.stores.edit']);
    $routes->post('delete', 'StoreController::delete', ['as' => 'admin.stores.delete']);
});

/**
 * Table Routes
 */
$routes->group("admin/tables", ["namespace" => "\Modules\Restaurant\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'TableController::index', ['as' => 'admin.tables']);
    $routes->get('list', 'TableController::list', ['as' => 'admin.tables.list']);
    $routes->match(['get', 'post'], 'create', 'TableController::create', ['as' => 'admin.tables.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'TableController::edit/$1', ['as' => 'admin.tables.edit']);
    $routes->post('delete', 'TableController::delete', ['as' => 'admin.tables.delete']);
});

/**
 * Category Routes
 */
$routes->group("admin/categories", ["namespace" => "\Modules\Restaurant\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'CategoryController::index', ['as' => 'admin.categories']);
    $routes->get('list', 'CategoryController::list', ['as' => 'admin.categories.list']);
    $routes->match(['get', 'post'], 'create', 'CategoryController::create', ['as' => 'admin.categories.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'CategoryController::edit/$1', ['as' => 'admin.categories.edit']);
    $routes->post('delete', 'CategoryController::delete', ['as' => 'admin.categories.delete']);
});

/**
 * Item Routes
 */
$routes->group("admin/items", ["namespace" => "\Modules\Restaurant\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'ItemController::index', ['as' => 'admin.items']);
    $routes->get('list', 'ItemController::list', ['as' => 'admin.items.list']);
    $routes->match(['get', 'post'], 'create', 'ItemController::create', ['as' => 'admin.items.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'ItemController::edit/$1', ['as' => 'admin.items.edit']);
    $routes->post('delete', 'ItemController::delete', ['as' => 'admin.items.delete']);
});
