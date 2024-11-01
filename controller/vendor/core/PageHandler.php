<?php

class PageHandler {

    public function __construct() {
        /** -------->  TODO Hardcoded values while organization selector has not been.  */
        $_SESSION['orgPhoto'] = '../../assets/images/placeholder.jpeg';
        $_SESSION['orgName'] = 'SCHEMA';
        $_SESSION['orgID'] = 1;
        $_SESSION['handler'] = serialize($this);
    }

    public function loadPage($page) {
        switch ($page) {
            case 'home':
                $this->loadDashboard(true);
                break;
            case 'reservations':
                $this->loadReservations();
                break;
            case 'products':
                $this->loadProducts();
                break;
            case 'schedule':
                $this->loadSchedule();
                break;
            case 'sales':
                $this->loadSales();
                break;
            default:
                $this->loadDashboard(false);
                break;
        }
    }

    public function loadDashboard($firstTime) {
        require_once __DIR__ . '/../home/DashboardController.php';
        $controller = new DashboardController();
        $controller->index($firstTime);
    }

    public function loadReservations() {
        require_once __DIR__ . '/../reservations/ReservationsController.php';
        $controller = new ReservationsPageController();
        $controller->index();
    }

    public function loadProducts() {
        require_once __DIR__ . '/../../vendor/products/ProductsController.php';
        $controller = new ProductsPageController();
        $controller->index();
    }

    public function loadSchedule() {
        require_once __DIR__ . '/../../vendor/schedule/ScheduleController.php';
        $controller = new ScheduleController();
        $controller->index();
    }

    public function loadSales() {
        require_once __DIR__ . '/../../vendor/sales/SalesController.php';
        $controller = new SalesController();
        $controller->index();
    }

    public function getUsername() {
        return $this -> {$_SESSION['user']};
    }


    public function getFromURL() {
        $this->loadPage($_GET['page']);
    }
}