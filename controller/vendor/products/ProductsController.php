<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../../../model/vendor/products/ProductsPageModel.php');

class ProductsController
{
    private $model;
    private $sessionID;

    public function __construct(){

        $this->model = new ProductsPageModel();
        
    }



    public function index()
    {
        // Validate the session ID
        if (!isset($_SESSION['org_id'])) {
            echo "Error: Session ID is not valid.";
            exit;
        }

        $orgId = $_SESSION['org_id'];

        // Fetch products for the current organization
        $products = $this->model->getProducts($orgId);

        // Include the view and pass the products data
        require 'view/vendor/products/products_view.php';
    }
}