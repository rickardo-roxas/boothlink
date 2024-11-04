<?php

// Starts session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// For error checking
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config/Connection.php';
require 'controller/core/Router.php';
require 'controller/core/PageHandler.php';

$router = new Router();
$pageHandler = new PageHandler();

// Auth routes
// Login route
$router->addRoute('POST', '/login', function() use ($conn, $pageHandler) {
    $pageHandler->renderAuth('/login', $conn);
});

$router->addRoute('GET', '/login', function() use ($conn, $pageHandler) {
    $pageHandler->renderAuth('/login', $conn);
});

// Signup route
$router->addRoute('POST', '/signup', function() use ($conn, $pageHandler){
    $pageHandler->renderAuth('/signup', $conn);
});

// Vendor routes
// Home route
$router->addRoute('GET', '/home', function() use ($pageHandler) {
    $firstTime = $_SESSION['first_time'] ?? false;
    $pageHandler->renderVendor('/home', $firstTime);
});

// Reservations route
$router->addRoute('GET', '/reservations', function() use ($pageHandler) {
    $pageHandler->renderVendor('/reservations', false);
});

// Products route
$router->addRoute('GET', '/products', function () use ($pageHandler) {
   $pageHandler->renderVendor('/products', false);
});

// Sales route
$router->addRoute('GET', '/sales', function() use ($pageHandler){
    $pageHandler->renderVendor('/sales', false);
});

// orgSelector
$router->addRoute('GET', '/org_select', function() use ($pageHandler) {
    $pageHandler->renderVendor('/org_select', false);
});

// Definition of Customer routes
// TODO by Finals

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $router->handleRequest();
    echo "User is logged in";
} else {
    $pageHandler = new PageHandler();
    $pageHandler->renderAuth('/login', $conn);

}