<?php
// Start the session only if it hasn't started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Autoload classes
spl_autoload_register(function ($class_name) {
    if (file_exists('controller/' . $class_name . '.php')) {
        include 'controller/' . $class_name . '.php';
    } elseif (file_exists('model/' . $class_name . '.php')) {
        include 'model/' . $class_name . '.php';
    } elseif (file_exists('view/' . $class_name . '.php')) {
        include 'view/' . $class_name . '.php';
    }
});

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    // User is logged in, show the hello message
    $controller = new HelloController();
    $controller->showMessage();
} else {

    /*
    $username = "ramon";
    require_once 'model/Dashboard.php';
    require_once 'controller/DashboardController.php';
    new DashboardController(new Dashboard($username));
    */

    $controller = new SalesController();
}
