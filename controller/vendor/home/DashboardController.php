<?php

class DashboardController {

    protected $model;

    public function __construct() {
        include(__DIR__.'/../model/Dashboard.php');
        $this->model = new Dashboard();
    }


    public function index($firstTime) {

        if ($firstTime) {
            header('Location: view/vendor/home_view.php');
        } else {
            header('Location: home_view.php');
        }
        exit();
    }
}

