<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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


// Create the controller and show the message
$controller = new HelloController();
$controller->showMessage();

//$controller = new SalesController();
