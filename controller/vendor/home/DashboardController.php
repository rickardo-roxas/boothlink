<?php

class DashboardController {
    protected $model;

    public function __construct() {
        include(__DIR__.'/../../../model/vendor/home/Dashboard.php');
        $this->model = new Dashboard();
    }

    public function index($firstTime) {
        if ($firstTime) {
            header('Location: /cs-312_boothlink/view/vendor/home/home_view.php');
        } else {
            header('Location: home_view.php');
        }
        exit();
    }
}

