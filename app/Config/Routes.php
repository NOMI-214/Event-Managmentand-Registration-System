<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Create a new instance of our RouteCollection class.


// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// ==================== PUBLIC ROUTES ====================

// Home routes
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

// Events routes (Public)
$routes->get('events', 'Event::index');
$routes->get('event/(:num)', 'Event::detail/$1');
$routes->post('event/(:num)/register', 'Event::register/$1');
$routes->get('event/success/(:num)', 'Event::success/$1');

// Temporary debug route
$routes->get('debug/write-test', 'Debug::writeTest');

// ==================== ADMIN ROUTES ====================

// User Authentication & Dashboard
$routes->get('login', 'UserAuth::login');
$routes->post('login', 'UserAuth::authenticate');
$routes->get('register', 'UserAuth::register');
$routes->post('register', 'UserAuth::storeRegister');
$routes->get('dashboard', 'UserAuth::dashboard');
$routes->get('logout', 'UserAuth::logout');
$routes->get('user/logout', 'UserAuth::logout');

// ==================== ADMIN ROUTES ====================
// Admin Authentication (Distinct from User)
$routes->get('admin/login', 'Auth::login');
$routes->post('admin/login', 'Auth::authenticate');
$routes->post('admin/authenticate', 'Auth::authenticate');
$routes->get('admin/logout', 'Auth::logout');

// Admin Dashboard (Protected)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'AdminDashboard::index');
    
    // Event Management
    $routes->get('events', 'AdminEvent::index');
    $routes->get('events/create', 'AdminEvent::create');
    $routes->post('events/store', 'AdminEvent::store');
    $routes->get('events/edit/(:num)', 'AdminEvent::edit/$1');
    $routes->post('events/update/(:num)', 'AdminEvent::update/$1');
    $routes->get('events/delete/(:num)', 'AdminEvent::delete/$1');
    
    // Participant Management
    $routes->get('participants', 'AdminParticipant::index');
    $routes->get('participants/event/(:num)', 'AdminParticipant::byEvent/$1');
    $routes->get('participants/delete/(:num)', 'AdminParticipant::delete/$1');
    
    // Export Routes
    $routes->get('participants/export/csv', 'AdminParticipant::exportCSV');
    $routes->get('participants/export/excel', 'AdminParticipant::exportExcel');
    $routes->get('participants/export/pdf', 'AdminParticipant::exportPDF');
    $routes->get('participants/export/csv/(:num)', 'AdminParticipant::exportEventCSV/$1');
    $routes->get('participants/export/excel/(:num)', 'AdminParticipant::exportEventExcel/$1');
    $routes->get('participants/export/pdf/(:num)', 'AdminParticipant::exportEventPDF/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
