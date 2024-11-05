<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../../../model/vendor/products/AddNewProductModel.php');

class AddProductsController{
    private $model;
    private $sessionID;

    public function __construct(){
        $this->model = new AddNewProductModel();
    }

    public function index(){
        // Validate the session ID
        if (!isset($_SESSION['org_id'])) {
            echo "Error: Session ID is not valid.";
            exit;
        }

        $orgId = $_SESSION['org_id'];

        // Add POST method here from query

        require 'view/vendor/products/add_product.php';
    }
}
