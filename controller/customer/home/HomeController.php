<?php

class HomeController
{
    private $model;

    public function __construct()
    {
        require_once 'model/customer/home/Home.php';
        $this-> model = new Home();
    }

    public function index() {


        require_once "view/customer/home/home_view.php";
    }

}
