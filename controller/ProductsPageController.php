<?php
require_once 'model/ProductsPageModel.php';

class ProductsPageController{
    private $model;

    public function __construct(){
        $this->model = new ProductsPageModel();
    }

    public function products($org_id){
        $products = $this->model->getProducts($org_id);

        include 'view/ProductsPageView.php';
    }
}