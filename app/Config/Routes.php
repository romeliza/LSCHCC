<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for users who are not authenticated (public routes)

// Location Route
 $routes->get('/locations', 'LocationController::index');

$routes->group('', ['filter' => 'NoAuthFilter'], function($routes) {
    // Authentication routes
    $routes->get('/', 'AuthenticationController::login'); // Home page redirects to login
    $routes->get('login', 'AuthenticationController::login'); // GET for login page
    $routes->post('login', 'AuthenticationController::login'); // POST for login submission
 
});

// Routes for authenticated users
$routes->group('', ['filter' => 'auth'], function($routes) {
    // Authentication routes
    $routes->get('logout', 'AuthenticationController::logout');

    // Route for administrator dashboard
    $routes->get('home', 'Home::index');
    $routes->get('dashboard', 'Home::index');
 

    // User management routes (accessible to admins or authorized users)
    $routes->get('user', 'UserController::index');
    $routes->get('user/add', 'UserController::add');
    $routes->post('user/add', 'UserController::add');
    $routes->get('user/edit', 'UserController::edit');
    $routes->post('user/edit', 'UserController::edit');
    $routes->get('user/delete', 'UserController::delete');
    $routes->post('user/delete', 'UserController::delete');
    $routes->post('user/toggleStatus', 'UserController::toggleStatus');

    // Medication management routes
    $routes->get('medication', 'MedicationController::index');
    $routes->get('medication/add', 'MedicationController::add');
    $routes->post('medication/add', 'MedicationController::add');
    $routes->get('medication/edit', 'MedicationController::edit');
    $routes->post('medication/edit', 'MedicationController::edit');
    $routes->get('medication/delete', 'MedicationController::delete');
    $routes->post('medication/delete', 'MedicationController::delete');

    // Medication Intake  routes
    $routes->get('medicationIntake', 'MedicationIntakeController::index');
    $routes->get('medicationIntake/add', 'MedicationIntakeController::add');
    $routes->post('medicationIntake/add', 'MedicationIntakeController::add');
    $routes->get('medicationIntake/edit', 'MedicationIntakeController::edit');
    $routes->post('medicationIntake/edit', 'MedicationIntakeController::edit');
    $routes->get('medicationIntake/delete', 'MedicationIntakeController::delete');
    $routes->post('medicationIntake/delete', 'MedicationIntakeController::delete');
    $routes->get('medicationIntake/mark', 'MedicationIntakeController::mark');
    $routes->post('medicationIntake/mark', 'MedicationIntakeController::mark');
    
    $routes->get('medicationIntake/completed', 'MedicationIntakeController::completedIntakes');

    // Patient  routes
    $routes->get('patient', 'PatientController::index');
    $routes->get('patient/add', 'PatientController::add');
    $routes->post('patient/add', 'PatientController::add');
    $routes->get('patient/edit', 'PatientController::edit');
    $routes->post('patient/edit', 'PatientController::edit');
    $routes->get('patient/delete', 'PatientController::delete');
    $routes->post('patient/delete', 'PatientController::delete');
    $routes->get('patient/status', 'PatientController::status');
    $routes->post('patient/status', 'PatientController::status');
    
    // Physician  routes
    $routes->get('physician', 'PhysicianController::index');
    $routes->get('physician/add', 'PhysicianController::add');
    $routes->post('physician/add', 'PhysicianController::add');
    $routes->get('physician/edit', 'PhysicianController::edit');
    $routes->post('physician/edit', 'PhysicianController::edit');
    $routes->get('physician/delete', 'PhysicianController::delete');
    $routes->post('physician/delete', 'PhysicianController::delete');
    
        // Report Routes
        $routes->get('report', 'ReportController::index');
        $routes->get('report/patient', 'ReportController::patient');
        $routes->get('report/physician', 'ReportController::physician');
        $routes->get('report/medication', 'ReportController::medication');
        $routes->get('report/medicationintake', 'ReportController::medicationintake');
        $routes->get('report/completedintake', 'ReportController::completedintake');
        $routes->get('report/opd', 'ReportController::opd');
        $routes->get('report/admission', 'ReportController::admission');
        $routes->get('report/discharged', 'ReportController::discharged');
        $routes->get('report/dischargedsummary', 'ReportController::dischargedsummary');
    
    // Profile Routes
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::edit');
    $routes->post('profile/deactivate', 'ProfileController::deactivate');

    // Access Denied Routes
    $routes->get('access/access-denied', 'AccessDeniedController::index');


    
});
