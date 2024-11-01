<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../../../model/vendor/products/ProductsPageModel.php');

class ProductsPageController{
    private $model;
    private $sessionID;

    public function __construct(){
        $this->sessionID = $_SESSION['orgID'];


        $this->model = new ProductsPageModel();
    }

    public function index(){
        $products = $this->model->getProducts($this->sessionID);

        header('Location: /cs-312_boothlink/view/vendor/products/products_view.php');
    }
}