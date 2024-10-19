<?php

class SalesController {

    private $handler;
    private $username;
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

     //   $xValues = $this ->getModel() -> getXValues();
     //   $yValues = $this -> getModel() -> getYValues();

     //   $performanceToday = $this -> getModel() -> getPerfToday();
     //   $performanceWeek = $this -> getModel() -> getPerfWeek();

     //   $categoryList = $this -> getModel() -> getCategoryList();

     //   $productList = $this -> getModel() -> getProductList();


        header('Location: view/vendor/DashboardView.php');
        exit();
    }
}