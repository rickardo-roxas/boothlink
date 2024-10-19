<?php

class SalesController {

    private $model;

    public function __construct() {
        include(__DIR__.'/../model/SalesModel.php');
        $this->model = new SalesModel();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function index() {

        header('Location: SalesView.php');
        exit();
    }
}