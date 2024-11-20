<?php

// Starts session
use controller\auth\Authenticator;
use controller\core\Router;
use controller\vendor\PageHandler;
use controller\vendor\products\EditProductsController;
use controller\vendor\reservations\ActionReservationsController;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// For error checking
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config/Connection.php';
require 'controller/core/Router.php';
require 'controller/auth/Authenticator.php';


$router = new Router();
$authenticator = new Authenticator();

// Auth routes
// Login route
$router->addRoute('POST', '/login', function() use ($conn, $authenticator) {
    $authenticator->renderAuth('/login', $conn);
});

$router->addRoute('GET', '/login', function() use ($conn, $authenticator) {
    $authenticator->renderAuth('/login', $conn);
});

// Signup route
$router->addRoute('POST', '/signup', function() use ($conn, $authenticator){
    $authenticator->renderAuth('/signup', $conn);
});

 /** -- Vendor routes -- */

if (isset($_SESSION['vendor_id'])) {

    require 'controller/vendor/PageHandler.php';
    $pageHandler = new PageHandler();

// Home route
    $router->addRoute('GET', '/home', function () use ($pageHandler) {
        if (!isset($_SESSION['org_id'])) {
            header('Location: /org_select');
            exit();
        }

        $firstTime = $_SESSION['first_time'] ?? false;
        $pageHandler->renderVendor('/home', $firstTime);
    });


// Reservations route
    $router->addRoute('GET', '/reservations', function () use ($pageHandler) {
        $pageHandler->renderVendor('/reservations', false);
    });

// Products route
    $router->addRoute('GET', '/products', function () use ($pageHandler) {
        $pageHandler->renderVendor('/products', false);
    });

// Add Products route
    $router->addRoute('GET', '/products/add-product', function () use ($pageHandler) {
        $pageHandler->renderVendor('/products/add-product', false);
    });

    $router->addRoute('POST', '/products/add-product', function () use ($pageHandler) {
        $pageHandler->renderVendor('/products/add-product', false);
    });

// SchedulePageModel route
    $router->addRoute('GET', '/schedule', function () use ($pageHandler) {
        $pageHandler->renderVendor('/schedule', false);
    });

    $router->addRoute('POST', '/schedule/add-schedule', function () use ($pageHandler) {
        $pageHandler->renderVendor('/schedule/add-schedule', false);
    });

// Sales route
    $router->addRoute('GET', '/sales', function () use ($pageHandler) {
        $pageHandler->renderVendor('/sales', false);
    });

// orgSelector
    $router->addRoute('GET', '/org_select', function () use ($pageHandler) {
        $pageHandler->renderVendor('/org_select', false);
    });

    $router->addRoute('GET', '/select_org', function () use ($pageHandler) {
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
    $router->addRoute('GET', '/products/edit-product', function () use ($pageHandler) {
        $pageHandler->renderVendor('/products/edit-product', false);
    });

// Edit Product POST route should go to EditProductsController
    $router->addRoute('POST', '/products/edit-product', function () use ($conn) {
        require_once __DIR__ . '/controller/vendor/products/EditProductsController.php';
        (new EditProductsController())->index();
    });

    $router->addRoute('POST', '/products/delete-product', function () use ($conn) {
        require_once __DIR__ . '/controller/vendor/products/EditProductsController.php';
        (new EditProductsController())->delete();
    });

    $router->addRoute('POST', '/reservations/complete', function () use ($conn) {
        require_once __DIR__ . '/controller/vendor/reservations/ActionReservationsController.php';
        (new ActionReservationsController())->completeReservation();
    });

    $router->addRoute('POST', '/reservations/reject', function () use ($conn) {
        require_once __DIR__ . '/controller/vendor/reservations/ActionReservationsController.php';
        (new ActionReservationsController())->rejectReservation();
    });

    /**Customer Side */
} else if (isset($_SESSION['customer_id'])) {
    require 'controller/customer/PageHandler.php';
    $pageHandler = new PageHandler();

    $router->addRoute('GET', '/home', function () use ($pageHandler) {
        $pageHandler->renderCustomer('/home');
    });

    $router->addRoute('GET', '/shop', function () use ($pageHandler) {
        $pageHandler->renderCustomer('/shop');
    });

    $router->addRoute('GET', '/reservations', function () use ($pageHandler) {
        $pageHandler->renderCustomer('/reservations');
    });

}

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $router->handleRequest();
} else {
    $authenticator = new Authenticator();
    $authenticator->renderAuth('/login', $conn);

}