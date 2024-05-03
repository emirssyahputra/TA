<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->add('login/cek', 'Login::cek');
$routes->add('Apply/(:num)', 'Apply::index/$1');
$routes->add('UbahPengguna/(:num)', 'UbahPengguna::index/$1');
$routes->add('UbahOutlet/(:num)', 'UbahOutlet::index/$1');
$routes->get('UbahJob/(:segment)', 'UbahJob::index/$1');
$routes->get('DetailPendaftar/(:segment)', 'DetailPendaftar::index/$1');
$routes->get('UbahStatusPendaftar/(:segment)', 'UbahStatusPendaftar::index/$1');
$routes->get('file/(:segment)', 'DetailPendaftar::downloadFile/$1');
$routes->get('pCareer', 'pCareer::index');
$routes->get('pHome', 'pHome::index');
$routes->get('pAbout', 'pAbout::index');
$routes->get('TambahOutlet', 'TambahOutlet::index');










/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}