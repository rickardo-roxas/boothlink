<?php

/**
 * Handles the rendition of pages.
 */
class PageHandler
{
    /**
     * Renders the Vendor view of a given webpage passed from the Router.
     * @param $path - The path passed from the Router.
     * @param $firstTime - Flag to indicate if it's the user's first time visiting the page.
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
                $controller = new ProductsController();
                $controller->index();
                break;

            case '/products/add-product':
                $title = 'Products';
                require __DIR__ . '/../../controller/vendor/products/AddProductsController.php';
                (new AddProductsController())->index(); 
                break;

            case '/schedule':
                $title = 'Schedule';
                require __DIR__ . '/../../controller/vendor/schedule/ScheduleController.php';
                $controller = new ScheduleController();
                $controller->index();
                break;

            case '/sales':
                $title = 'Sales';
                require __DIR__ . '/../../controller/vendor/sales/SalesController.php';
                $controller = new SalesController();
                $controller->index();
                break;

            case '/org_select':
                $title = 'Org Select';
                require __DIR__ . '/../../model/vendor/VendorQueries.php';
                $vendorQueries = new VendorQueries($conn);

                require __DIR__ . '/../../model/vendor/OrgSelectModel.php';
                $orgSelectModel = new OrgSelectModel($vendorQueries);

                require __DIR__ . '/../../controller/vendor/OrgSelectController.php';
                $controller = new OrgSelectController($orgSelectModel);
                $controller->displayOrgSelector();
                break;

            case '/select_org':
                $title = 'Organization Selection';
                if (isset($_GET['org_id'])) {
                    $_SESSION['org_id'] = $_GET['org_id'];
                    // redirect to home page
                    header('Location: /home'); // ensure this points to the correct path
                    exit();
                } else {
                    // redirect back to org_select if no org_id was provided
                    header("Location: /org_select");
                    exit();
                }
                break;

            default:
                echo "404 Not Found";
                break;
        }

        $_SESSION['page_title'] = $title;
    }

    /**
     * Renders the Authentication view of a given webpage passed from the router.
     * @param $path - The path passed from the Router.
     * @param $conn - Database connection.
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
                } else {
                    session_destroy();
                    require __DIR__ . '/../../controller/auth/LoginController.php';
                    $controller = new LoginController($conn);
                    $controller->handleLogin();
                    exit();
                }
                break;

            case '/signup':
                $title = 'Signup';
                // Include signup controller and logic if available
                break;

            default:
                echo "404 Not Found";
                break;
        }

        $_SESSION['page_title'] = $title;
    }
}
