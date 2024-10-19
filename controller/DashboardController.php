<?php

include 'view/vendor/pageFragments/Header.php';

class DashboardController {

    protected $model;

    public function __construct($handler, $dashboard) {
        $this -> model = $dashboard;
    }


    public function index() {
        $orgPhoto = '../../assets/images/placeholder.jpeg';
        $orgName = "SCHEMA";
        header("Location: view/vendor/DashboardView.php?orgPhoto=$orgPhoto&orgName=$orgName");
        exit();
    }
}

