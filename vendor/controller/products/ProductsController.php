<?php

namespace controller\vendor\products;

use model\vendor\products\ProductsPageModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_GET['category'])) {
    $filter = $_GET['category'];
    $controller = new ProductsController();
    $controller->filteredCategory($filter);

}

class ProductsController
{
    private $model;
    private $sessionID;

    public function __construct()
    {

        include('model/products/ProductsPageModel.php');
        $this->model = new ProductsPageModel();

    }

    public function validate()
    {
        // Validate the session ID
        if (!isset($_SESSION['org_id'])) {
            echo "Error: Session ID is not valid.";
            exit;
        }
    }


    public function index()
    {

        $this->validate();

        $orgId = $_SESSION['org_id'];

        // Fetch products for the current organization
        $products = $this->model->getProducts($orgId);

        // Include the view and pass the products data
        require 'view/products/products_view.php';
    }

    public function filteredCategory($filter)
    {
        $this->validate();

        $orgId = $_SESSION['org_id'];

        // Fetch products for the current organization
        $products = $this->model->getFilteredProducts($orgId, $filter);

        // Include the view and pass the products data
        require 'view/products/products_view.php';

    }
}