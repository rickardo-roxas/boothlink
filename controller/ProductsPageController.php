<?php
require_once 'model/ProductsPageModel.php';

class ProductsPageController{
    private $model;

    public function __construct(){
        $this->model = new ProductsPageModel();
    }

    public function products(){
        $products = $this->model->getProducts(1);
        
        include '/view/vendor/ProductsPageView.php';
    }
}