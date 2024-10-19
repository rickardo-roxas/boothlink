<?php

class PageHandler {

    public function __construct() {

        /** -------->  TODO Hardcoded values while organization selector has not been.  */
        session_start();

        $_SESSION['orgPhoto'] = '../../assets/images/placeholder.jpeg';
        $_SESSION['orgName'] = 'SCHEMA';


        $_SESSION['handler'] = serialize($this);

        $this->loadPage("first");

    }

    public function loadPage($page) {
        switch ($page) {
            case "first":
                $this->loadDashboard(true);
                break;
            case "reservations":
                $this->loadReservations();
                break;
            case "products":
                $this->loadProducts();
                break;
            case "schedule":
                $this->loadSchedule();
                break;
            case "sales":
                $this->loadSales();
                break;
            default:
                $this->loadDashboard(false);
                break;
        }
    }

    public function loadDashboard($firstTime) {
        include 'DashboardController.php';
        $controller = new DashboardController();
        $controller->index($firstTime);
    }

    public function loadReservations() {
        // TODO: Will not work yet since the files have yet to be created
        include 'ReservationsController.php';
        $controller = new ReservationsController();
        $controller->index();
    }

    public function loadProducts() {
        // TODO: Will not work yet since the files have yet to be created
        include 'ProductsController.php';
        $controller = new ProductsController();
        $controller->index();
    }

    public function loadSchedule() {
        include 'ScheduleController.php';
        $controller = new ScheduleController();
        $controller->index();
    }

    public function loadSales() {
        include 'SalesController.php';
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