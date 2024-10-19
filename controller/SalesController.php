<?php

class SalesController {

    private $model;

    public function __construct() {

        $this->model = new SalesModel();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function index() {

        $xValues = $this ->getModel() -> getXValues();
        $yValues = $this -> getModel() -> getYValues();

        $performanceToday = $this -> getModel() -> getPerfToday();
        $performanceWeek = $this -> getModel() -> getPerfWeek();

        $categoryList = $this -> getModel() -> getCategoryList();

        $productList = $this -> getModel() -> getProductList();


        include 'view/vendor/SalesView.php';

}
    

}