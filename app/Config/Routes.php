<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');
$routes->get('/register', 'Main::index');
$routes->post('/register', 'Main::register');

$routes->get('/customer/dashboard', 'Customer::dashboard');
$routes->get('/employee/dashboard', 'Dashboard::employee');
$routes->get('/customer/bookings', 'Customer::bookings');
$routes->post('/customer/bookings', 'Customer::createBooking');
$routes->post('/customer/bookings/cancel/(:num)', 'Customer::cancelBooking/$1');
$routes->get('/customer/profile', 'Customer::profile');
$routes->post('/customer/profile', 'Customer::updateProfile');
$routes->get('/customer/history', 'Customer::history');
$routes->get('/customer/notifications', 'Customer::notifications');
$routes->get('/customer/support', 'Customer::support');
$routes->post('/customer/support', 'Customer::createTicket');

$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/users', 'Admin::users');
$routes->post('/admin/users/status/(:num)', 'Admin::setUserStatus/$1');
$routes->get('/admin/bookings', 'Admin::bookings');
$routes->post('/admin/bookings/update/(:num)', 'Admin::updateBooking/$1');
$routes->get('/admin/announcements', 'Admin::announcements');
$routes->post('/admin/announcements', 'Admin::createAnnouncement');
$routes->get('/admin/reports', 'Admin::reports');

$routes->get('/technician/dashboard', 'Technician::dashboard');
$routes->post('/technician/checkin/(:num)', 'Technician::checkIn/$1');
$routes->post('/technician/report/(:num)', 'Technician::reportIssue/$1');
