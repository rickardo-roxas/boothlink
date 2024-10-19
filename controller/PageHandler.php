<?php

class PageHandler {

    private $username;
    public function __construct($username) {
        $this->username = $username;
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
        $controller = new DashboardController($this->getUsername());
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
        $controller = new SalesController($this->getUsername());
        $controller->index();
    }

    public function getUsername() {
        return $this->username;
    }

}