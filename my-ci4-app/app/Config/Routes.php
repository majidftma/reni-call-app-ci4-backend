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
$routes->get('api/docs/language', 'DocsController::languagesDoc');
$routes->get('api/docs/wallet', 'DocsController::walletsDoc');


// $routes->post('auth/refresh-token', 'AuthController::refreshToken');
$routes->post('/auth/refresh-tokens', 'AuthController::updateTokensWithRefreshToken');



$routes->group('admin', ['namespace' => 'App\Controllers\admin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('login', 'AdminController::login');
    $routes->post('authenticate', 'AdminController::authenticate');
    $routes->get('logout', 'AdminController::logout');
    $routes->post('create', 'AdminController::createAdmin'); // Route to create an admin
});

$routes->group('admin', ['namespace' => 'App\Controllers', 'filter' => 'auth','jwt'], function ($routes) {
    $routes->get('dashboard', 'admin\AdminController::index');
    $routes->get('settings', 'admin\AdminController::settings');



    $routes->get('plans', 'admin\AdminController::getPlans');
    $routes->get('plans/create', 'admin\AdminController::postPlans');
    $routes->post('plans/store', 'admin\AdminController::store');
    $routes->get('plans/delete/(:num)', 'PlanController::delete/$1');
    $routes->get('plans/edit/(:num)', 'PlanController::edit/$1');
    $routes->post('plans/update/(:num)', 'PlanController::update/$1');



    $routes->get('users', 'admin\AdminController::getUsers');

});



$routes->get('setup/create-admin', 'SetupController::createAdmin');
$routes->post('api/create-or-update-user', 'UserController::createOrUpdateUser');


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

$routes->group('api/plans', ['namespace' => 'App\Controllers', 'filter' => 'jwt'], function ($routes) {
    $routes->post('', 'PlanController::createPlan'); // Create a new plan
    $routes->get('', 'PlanController::getPlans'); // Get all plans
    $routes->get('(:num)', 'PlanController::getPlanById/$1'); // Get a specific plan by ID
});

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('payment/create-order', 'PaymentController::createOrder');
    $routes->post('payment/verify', 'PaymentController::verifyPayment');
});



// Routes.php
$routes->group('api/wallet', function ($routes) {
    $routes->get('balance/(:num)', 'WalletController::getBalance/$1');
    $routes->post('credit', 'WalletController::creditWallet');
    $routes->post('debit', 'WalletController::debitWallet');
});
