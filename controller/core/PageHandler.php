<?php

/**
 * Handles the rendition of pages.
 */
class PageHandler
{
    /**
     * Renders the Vendor view of a given webpage passed from the Router.
     * @param $path - The path passed from the Router.
     * @return void
     */
    public function renderVendor($path, $firstTime) {
        switch ($path) {
            case '/home':
                require __DIR__ . '/../../controller/vendor/home/HomeController.php';
                $controller = new HomeController();
                $controller->index($firstTime);
                break;

            case '/reservations':
                require __DIR__ . '/../../controller/vendor/reservations/ReservationsController.php';
                $controller = new ReservationsController();
                $controller->index();
                break;

            case '/products':
                require __DIR__ . '/../../../controller/vendor/home/ProductsController.php';
                (new ProductsController())->index();
                break;

            case '/sales':
                require __DIR__ . '/../../../controller/vendor/home/SalesController.php';
                new SalesController();
                break;

            default:
                echo "404 Not Found";
        }
    }

    /**
     * Renders the Authentication view of a given webpage passed from the router.
     * @param $path - The path passed from the Router.
     * @return void
     */
    public function renderAuth($path, $conn) {
        switch ($path) {
            case '/login':
                if (!isset($_SESSION['user'])) {
                    require __DIR__ . '/../../controller/auth/LoginController.php';
                    $controller = new LoginController($conn);
                    $controller->handleLogin();
                }
                else {
                    header("Location: /home");
                    exit();
                }
                break;
            case '/signup':
                // require __DIR__ . '/../../../controller/auth/SignupController.php';
                break;
            default:
                echo "404 Not Found.";
        }
    }

    public function pageTitle($path) {

    }
    // TODO: renderCustomer, by Finals
}