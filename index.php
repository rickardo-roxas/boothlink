<?php

// Start the session only if it hasn't started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $conn;

// For error checking
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload classes
spl_autoload_register(function ($class_name) {
    $paths = [
        'controller/vendor/core/' . $class_name . '.php',

        // For vendor classes
        'controller/vendor/' . $class_name . '.php',
        'model/vendor/' . $class_name . '.php',
        'view/vendor/' . $class_name . '.php',

        // For login and signup
        'controller/auth/' . $class_name . '.php',
        'model/auth/' . $class_name . '.php',
        'view/auth/' . $class_name . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists(__DIR__ . '/' . $path)) {
            include_once __DIR__ . '/' . $path;
            return;
        }
    }
});

include 'config/Connection.php';

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    require_once 'controller/vendor/core/Router.php';
    require_once 'controller/vendor/core/PageHandler.php';
    $router = new Router();
    $router->route($_SERVER['REQUEST_URI']);
} else {
    require_once 'controller/auth/LoginController.php';
    $controller = new LoginController($conn);
    $controller->handleLogin();
}




