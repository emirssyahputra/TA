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
$routes->add('logins/cek', 'Logins::cek');
$routes->add('loging/cek', 'Loging::cek');
$routes->add('Detailguru/(:num)', 'Detailguru::index/$1');
$routes->add('datasiswadetail/(:num)', 'datasiswadetail::index/$1');
$routes->add('datalanggar/(:num)', 'datalanggar::index/$1');
$routes->add('tambahlanggar/(:num)', 'tambahlanggar::index/$1');
$routes->post('/datasiswadetail/update/(:segment)', 'Datasiswadetail::update/$1');
$routes->get('datalanggar/hapus/(:num)', 'Datalanggar::hapusRiwayat/$1');
$routes->post('import/unggah', 'Import::unggah');
$routes->post('print/printPdf', 'Cetak::printPdf');
$routes->get('cetakortu', 'Cetakortu::index');
$routes->post('cetakortu/generate-pdf', 'Cetakortu::generatePdf');











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