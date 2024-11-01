<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../model/ProductsPageModel.php');

class ProductsPageController{
    private $model;
    private $sessionID;

    public function __construct(){
        $this->sessionID = $_SESSION['orgID'];


        $this->model = new ProductsPageModel();
    }

    public function index(){
        $products = $this->model->getProducts($this->sessionID);

        header('Location: products_view.php?products=' . urlencode(serialize($products)));
    }
}