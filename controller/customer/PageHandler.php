<?php
class PageHandler
{

    public function renderCustomer($path) {
        $title = '';

        switch ($path) {
            case 'shop':
                $title = 'Shop';
                require __DIR__ . '/../../controller/customer/home/ShopController.php';
                (new ShopController()) -> index();
                break;
            case 'orders':
                $title = 'Orders';
                require __DIR__ . '/../../controller/customer/home/OrdersController.php';
                (new OrdersController()) -> index();
                break;
            case 'product':
                $title = 'Product';
                break;
            case 'reserve':
                $title = 'Reserve';
                break;
            case 'checkout':
                $title = 'Checkout';
                break;
            default:
                $title = 'Home';
                require __DIR__ . '/../../controller/customer/home/HomeController.php';
                $controller = new HomeController();
                $controller->index();
                break;
        }

    }
}
