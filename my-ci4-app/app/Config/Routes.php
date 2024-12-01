<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api/languages', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('', 'LanguageController::create'); // POST: Add a new language
    $routes->get('', 'LanguageController::index'); // GET: Fetch all languages
    $routes->get('(:num)', 'LanguageController::show/$1'); // GET: Fetch language by ID
});
