<?php

class DashboardController {

    protected $model;

    public function __construct($dashboard) {
        $this -> model = $dashboard;
    }


    public function index() {
        $orgPhoto = '../../assets/images/placeholder.jpeg';
        $orgName = "SCHEMA";

        header('Location: view/vendor/DashboardView.php');
        exit();
    }
}

