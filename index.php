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
    if (!isset($_SESSION['org_id'])) {
        header('Location: /org_select');
        exit();
    }

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

// Add Products route
$router->addRoute('GET', '/products/add-product', function () use ($pageHandler){
    $pageHandler->renderVendor('/products/add-product', false);
});

$router->addRoute('POST', '/products/add-product', function () use ($pageHandler){
    $pageHandler->renderVendor('/products/add-product', false);
});

// Schedule route
$router->addRoute('GET', '/schedule', function () use ($pageHandler) {
    $pageHandler->renderVendor('/schedule', false);
 });

$router->addRoute('POST', '/schedule/add-schedule', function () use ($pageHandler){
    $pageHandler->renderVendor('/schedule/add-schedule', false);
});

// Sales route
$router->addRoute('GET', '/sales', function() use ($pageHandler){
    $pageHandler->renderVendor('/sales', false);
});

// orgSelector
$router->addRoute('GET', '/org_select', function() use ($pageHandler) {
    $pageHandler->renderVendor('/org_select', false);
});

$router->addRoute('GET', '/select_org', function() use ($pageHandler) {
    if (isset($_GET['org_id'])) {
        $_SESSION['org_id'] = $_GET['org_id']; // Save the selected org ID in the session
        header('Location: /cs-312_boothlink/home'); // Redirect to the home page
        exit();
    } else {
        header('Location: /org_select'); // Redirect back if no org_id is provided
        exit();
    }
});


// Edit Product GET route
$router->addRoute('GET', '/products/edit-product', function() use ($pageHandler) {
    $pageHandler->renderVendor('/products/edit-product', false);
});

// Edit Product POST route should go to EditProductsController
$router->addRoute('POST', '/products/edit-product', function() use ($conn) {
    require_once __DIR__ . '/controller/vendor/products/EditProductsController.php';
    (new EditProductsController())->index();
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