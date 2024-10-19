<?php

class PageHandler {

    public function __construct() {

        $_SESSION['handler'] = serialize($this);

        $this->loadPage("");
    }

    public function loadPage($page) {
        switch ($page) {
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
                $this->loadDashboard();
                break;
        }
    }

    public function loadDashboard() {
        $controller = new DashboardController(new Dashboard());
        $controller->index();
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