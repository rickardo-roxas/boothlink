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

include 'model/Connection.php'; 

// Check if the user is logged in
if (isset($_SESSION['user'])) {


    $handler = new PageHandler();
    exit();

} else {

    require_once 'controller/LoginController.php';  
    $controller = new LoginController($conn);
    $controller->handleLogin();
}




