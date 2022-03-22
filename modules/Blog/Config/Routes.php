<?php

$routes->group("blog", ["namespace" => "\Modules\Blog\Controllers"], function ($routes) {

    $routes->get("/", "BlogController::index");
    $routes->get("a", "BlogController::list");
});
