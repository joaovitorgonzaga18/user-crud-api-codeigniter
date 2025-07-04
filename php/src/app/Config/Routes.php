<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Home::index');
$routes->post('login', 'Api\UsersController::login');
$routes->get('logout', 'Api\UsersController::logout');
$routes->get('/main', 'Api\UsersController::index');

// JWT protected routes
$routes->group('users', ['namespace' => 'App\Controllers\Api', 'filter' => 'jwt'], static function($routes) {
    $routes->post('create', 'UsersController::create');
    $routes->get('/', 'UsersController::getAll');
    $routes->get('(:num)', 'UsersController::get/$1');
    $routes->put('update/(:num)', 'UsersController::update/$1');
    $routes->delete('delete/(:num)', 'UsersController::delete/$1');
});
