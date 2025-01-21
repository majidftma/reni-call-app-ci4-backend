<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('send-otp', 'OtpController::sendOtp');
$routes->post('verify-otp', 'OtpController::verifyOtp');
$routes->get('api/docs/otp', 'DocsController::index');
$routes->get('api/docs/user', 'DocsController::userDoc');
$routes->get('api/docs/plan', 'DocsController::plansDoc');
$routes->get('api/docs/payment', 'DocsController::paymentsDoc');





$routes->group('api/languages', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('', 'LanguageController::create'); // POST: Add a new language
    $routes->get('', 'LanguageController::index'); // GET: Fetch all languages
    $routes->get('(:num)', 'LanguageController::show/$1'); // GET: Fetch language by ID
});

$routes->group('api/users', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('', 'UserController::create'); // Create a user
    $routes->get('', 'UserController::getUsers'); // Get all users
    $routes->get('(:num)', 'UserController::getUserById/$1'); // Get user by ID
});

$routes->group('api/plans', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('', 'PlanController::createPlan'); // Create a new plan
    $routes->get('', 'PlanController::getPlans'); // Get all plans
    $routes->get('(:num)', 'PlanController::getPlanById/$1'); // Get a specific plan by ID
});

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('payment/create-order', 'PaymentController::createOrder');
    $routes->post('payment/verify', 'PaymentController::verifyPayment');
});
