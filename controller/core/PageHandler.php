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
        $title = '';

        switch ($path) {
            case '/home':
                $title = 'Home';
                require __DIR__ . '/../../controller/vendor/home/HomeController.php';
                $controller = new HomeController();
                $controller->index($firstTime);
                break;

            case '/reservations':
                $title = 'Reservations';
                require __DIR__ . '/../../controller/vendor/reservations/ReservationsController.php';
                $controller = new ReservationsController();
                $controller->index();
                break;

            case '/products':
                $title = 'Products';
                require __DIR__ . '/../../controller/vendor/products/ProductsController.php';
                (new ProductsController())->index();
                break;

            case '/sales':
                $title = 'Sales';
                require __DIR__ . '/../../../controller/vendor/sales/SalesController.php';
                new SalesController();
                break;

            default:
                echo "404 Not Found";
        }
        $_SESSION['page_title'] = $title;
    }

    /**
     * Renders the Authentication view of a given webpage passed from the router.
     * @param $path - The path passed from the Router.
     * @return void
     */
    public function renderAuth($path, $conn) {
        $title = '';

        switch ($path) {
            case '/login':
                $title = 'Login';
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
                $title = 'Signup';
                // require __DIR__ . '/../../../controller/auth/SignupController.php';
                break;
            default:
                echo "404 Not Found.";
        }

        $_SESSION['page_title'] = $title;
    }
}