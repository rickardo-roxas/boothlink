<?php

class DashboardController {

    protected $model;

    public function __construct() {
        include(__DIR__.'/../model/Dashboard.php');
        $this->model = new Dashboard();
    }


    public function index($firstTime) {

        if ($firstTime) {
            header('Location: view/vendor/DashboardView.php');
        } else {
            header('Location: DashboardView.php');
        }
        exit();
    }
}

