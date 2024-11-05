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

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            require 'view/vendor/products/add_product.php'; 
        }

        // Add POST method here from query
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $prod_serv_name = $_POST['name'];
            $category = $_POST['type'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $image_src = "dummysource.png";

            $this->model->addProduct($orgId, $status, $category, $prod_serv_name, $price, $description, $image_src);

            echo "Product added succesfully"; //TO BE AN ALERT FOR JAVASCRIPT
            exit();
        }
    }
}
