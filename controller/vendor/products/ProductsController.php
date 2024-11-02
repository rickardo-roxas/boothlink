<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../../../model/vendor/products/ProductsPageModel.php');

class ProductsController
{
    private $model;
    private $sessionID;

    public function __construct(){
        $this->sessionID = $_SESSION['org_id'];

        $this->model = new ProductsPageModel();

        if (isset($_SESSION['org_id'])) {
            $this->sessionID = $_SESSION['org_id'];
        } else {
            echo "Error: 'orgID' is not set in the session.";
            exit();
        }
    }

    public function index(){
        $products = $this->model->getProducts($this->sessionID);

        require_once 'view/vendor/products/products_view.php';
    }
}