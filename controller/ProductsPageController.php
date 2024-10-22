<?php
include 'model/ProductsPageModel.php';
class ProductsPageController{
    private $model;
    public function __construct(){
        $this->model = new ProductsPageModel();
    }

    public function showProducts($org_id){
        $products = $this->model->getProducts($org_id);
        include 'view/vendor/ProductsPageView.php';

    }
}