<?php

class SalesController {

    public function __construct() {
        $model = new SalesModel();

        $xValues = $model -> getXValues();
        $yValues = $model -> getYValues();

        $performanceToday = $model -> getPerfToday();
        $performanceWeek = $model -> getPerfWeek();

        $categoryList = $model -> getCategoryList();

        $productList = $model -> getProductList();


        include 'view/SalesView.php';

    }
    

}