<?php

/**
 * Employer Routes
 */
$routes->group("admin/employers", ["namespace" => "\Modules\medical\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'EmployerController::index', ['as' => 'admin.employers']);
    $routes->get('list', 'EmployerController::list', ['as' => 'admin.employers.list']);
    $routes->match(['get', 'post'], 'create', 'EmployerController::create', ['as' => 'admin.employers.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'EmployerController::edit/$1', ['as' => 'admin.employers.edit']);
    $routes->post('delete', 'EmployerController::delete', ['as' => 'admin.employers.delete']);
});

/**
 * Doctor Routes
 */
$routes->group("admin/doctors", ["namespace" => "\Modules\medical\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'DoctorController::index', ['as' => 'admin.doctors']);
    $routes->get('list', 'DoctorController::list', ['as' => 'admin.doctors.list']);
    $routes->match(['get', 'post'], 'create', 'DoctorController::create', ['as' => 'admin.doctors.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'DoctorController::edit/$1', ['as' => 'admin.doctors.edit']);
    $routes->post('delete', 'DoctorController::delete', ['as' => 'admin.doctors.delete']);
});

/**
 * LabAdmin Routes
 */
$routes->group("admin/labadmins", ["namespace" => "\Modules\medical\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'LabAdminController::index', ['as' => 'admin.labadmins']);
    $routes->get('list', 'LabAdminController::list', ['as' => 'admin.labadmins.list']);
    $routes->match(['get', 'post'], 'create', 'LabAdminController::create', ['as' => 'admin.labadmins.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'LabAdminController::edit/$1', ['as' => 'admin.labadmins.edit']);
    $routes->post('delete', 'LabAdminController::delete', ['as' => 'admin.labadmins.delete']);
});

/**
 * Employee Routes
 */
$routes->group("admin/employees", ["namespace" => "\Modules\medical\Controllers", "filter" => "auth"], function ($routes) {
    $routes->get('/', 'EmployeeController::index', ['as' => 'admin.employees']);
    $routes->get('list', 'EmployeeController::list', ['as' => 'admin.employees.list']);
    $routes->match(['get', 'post'], 'import', 'EmployeeController::import', ['as' => 'admin.employees.import']);
    $routes->match(['get', 'post'], 'create', 'EmployeeController::create', ['as' => 'admin.employees.create']);
    $routes->match(['get', 'post'], '(:num)/edit', 'EmployeeController::edit/$1', ['as' => 'admin.employees.edit']);
    $routes->get('(:num)', 'EmployeeController::view/$1', ['as' => 'admin.employees.view']);
    $routes->post('delete', 'EmployeeController::delete', ['as' => 'admin.employees.delete']);

    $routes->post('savePersonalHistory/(:num)', 'EmployeeController::savePersonalHistory/$1', ['as' => 'admin.employees.savePersonalHistory']);
});
