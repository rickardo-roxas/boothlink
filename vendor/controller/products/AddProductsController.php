<?php

namespace controller\vendor\products;

use model\vendor\products\AddNewProductModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('vendor/model/products/AddNewProductModel.php');

class AddProductsController
{
    private $model;
    private $sessionID;

    public function __construct()
    {
        $this->model = new AddNewProductModel();
    }

    public function index()
    {

        // Validate the session ID
        if (!isset($_SESSION['org_id'])) {
            echo "Error: Session ID is not valid.";
            exit;
        }

        $orgId = $_SESSION['org_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require 'vendor/view/products/add_product.php';
        }

        // Add POST method here from query
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $prod_serv_name = $_POST['name'];
            $category = $_POST['type'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $selected_schedule_ids = isset($_POST['schedule_ids']) ? $_POST['schedule_ids'] : [];


            if (isset($_FILES['file']) && count($_FILES['file']['name']) > 0) {
                $target_dir = "shared/assets/prod_img/";

                // Loop through each file
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    $tmp_name = $_FILES['file']['tmp_name'][$i]; // Temporary file path
                    $file_name = basename($_FILES['file']['name'][$i]); // Original file name

                    // Define the target file path
                    $target_file = $target_dir . $file_name;

                    // Move the file to the target directory
                    move_uploaded_file($tmp_name, $target_file);

                }
                //  $image_src = "dummysource.png"
                $this->model->addProduct($orgId, $status, $category, $prod_serv_name, $price, $description, $file_name, $selected_schedule_ids);


                $_SESSION['product_added'] = true;

                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
    }
}
