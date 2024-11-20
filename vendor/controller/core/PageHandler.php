<?php

namespace controller\vendor;

use controller\vendor\home\HomeController;
use controller\vendor\products\AddProductsController;
use controller\vendor\products\EditProductsController;
use controller\vendor\products\ProductsController;
use controller\vendor\reservations\ReservationsController;
use controller\vendor\sales\SalesController;
use controller\vendor\schedule\AddScheduleController;
use controller\vendor\schedule\ScheduleController;
use model\vendor\OrgSelectModel;
use model\vendor\VendorQueries;

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
    public function renderVendor($path, $firstTime)
    {
        $title = '';

        switch ($path) {
            case '/home':
                $title = 'Home';
                require ('vendor/controller/home/HomeController.php');
                $controller = new HomeController();
                $controller->index($firstTime);
                break;

            case '/reservations':
                $title = 'Reservations';
                require ('vendor/controller/reservations/ReservationsController.php');
                $controller = new ReservationsController();
                $controller->index();
                break;

            case '/products':
                $title = 'Products';
                require ('vendor/controller/products/ProductsController.php');
                $controller = new ProductsController();
                $controller->index();
                break;

            case '/products/add-product':
                $title = 'Products';
                require ('vendor/controller/products/AddProductsController.php');
                (new AddProductsController())->index();
                break;

            case '/schedule':
                $title = 'SchedulePageModel';
                require ('vendor/controller//schedule/ScheduleController.php');
                $controller = new ScheduleController();
                $controller->index();
                break;

            case '/schedule/add-schedule':
                require ('vendor/controller//schedule/AddScheduleController.php');
                (new AddScheduleController())->addSchedule();
                break;
            case '/sales':
                $title = 'Sales';
                require ('vendor/controller//sales/SalesController.php');
                $controller = new SalesController();
                $controller->index();
                break;

            case '/org_select':
                $title = 'Org Select';
                require ('vendor/model/VendorQueries.php');
                $vendorQueries = new VendorQueries($conn);

                require ('vendor/model/OrgSelectModel.php');
                $orgSelectModel = new OrgSelectModel($vendorQueries);

                require ('vendor/controller/OrgSelectController.php');
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

            case '/products/edit-product':
                $title = 'Edit Product';
                require ('vendor/controller//products/EditProductsController.php');
                $controller = new EditProductsController();
                $prod_id = $_GET['prod_id'] ?? null;
                $controller->index($prod_id);
                break;

            default:
                echo "404 Not Found";
                break;
        }
        $_SESSION['page_title'] = $title;
    }
}
