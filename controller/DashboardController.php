<?php

include 'view/vendor/pageFragments/Header.php';

class DashboardController {

    protected $model;

    public function __construct($dashboard) {
        $this -> model = $dashboard;

        $this->index();
    }


    public function index() {
        $orgPhoto = '../../assets/images/placeholder.jpeg';
        $orgName = "SCHEMA";
        header("Location: view/vendor/DashboardView.php?orgPhoto=$orgPhoto&orgName=$orgName");

        exit();
    }
}

