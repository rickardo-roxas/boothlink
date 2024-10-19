<?php

class PageHandler {

    public function __construct() {

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
        $controller = new ReservationsController($this->getUsername());
        $controller->index();
    }

    public function loadProducts() {
        $controller = new ProductsController(this->getUsername());
        $controller->index();
    }

    public function loadSchedule() {
        $controller = new ScheduleController(this->getUsername());
        $controller->index();
    }

    public function loadSales() {
        include 'SalesController.php';
        $controller = new SalesController($this, $this->getUsername());
        $controller->index();
    }

    public function getUsername() {
        return $this -> {$_SESSION['user']};
    }


    public function getFromURL() {
        $this->loadPage($_GET['page']);
    }
}