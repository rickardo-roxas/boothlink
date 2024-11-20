<?php

namespace controller\vendor\products;

use model\vendor\products\EditProductsModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/../../../model/vendor/products/EditProductsModel.php');

class EditProductsController
{
    private $editProductsModel;

    public function __construct()
    {
        $this->editProductsModel = new EditProductsModel();
    }

    public function index()
    {
        if (!isset($_SESSION['org_id'])) {
            header("Location: /cs-312-boothlink/login");
            exit();
        }

        $prod_id = $_GET['prod_id'] ?? $_POST['prod_id'] ?? null;

        // If product ID is not provided, show an error
        if (!$prod_id) {
            echo "Product ID is missing.";
            exit;
        }

        // Handle GET request: Display the product data
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->handleGetRequest($prod_id);
        }

        // Handle POST request: Update the product data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->handlePostRequest($prod_id);
        }
    }

    public function delete()
    {

        $prod_id = $_POST['prod_id'] ?? null;

        if ($prod_id) {
            $result = $this->editProductsModel->deleteProducts($prod_id);

            if ($result) {
                header("Location: /cs-312_boothlink/products?success=1");
            } else {
                header("Location: /cs-312_boothlink/products?error=1");
            }
        } else {
            echo "Product ID missing.";
        }
        exit();
    }

    // Handle GET request: Fetch and display the product data
    private function handleGetRequest($prod_id)
    {
        $productData = $this->editProductsModel->getProductsByID($prod_id);

        if ($productData) {
            require 'vendor/view/products/edit_product.php'; // Render the edit form
        } else {
            echo "Product not found.";
            exit();
        }
    }

    // Handle POST request: Update product in the database
    private function handlePostRequest($prod_id)
    {
        // Collect and sanitize form inputs
        $prod_serv_name = trim($_POST['name'] ?? '');
        $category = $_POST['type'] ?? '';
        $price = floatval($_POST['price'] ?? 0);
        $status = $_POST['status'] ?? '';
        $description = trim($_POST['description'] ?? '');

        if (empty($prod_serv_name) || empty($category) || empty($price) || empty($status) || empty($description)) {
            $_SESSION['error'] = "Please fill in all required fields.";
            header("Location: /cs-312-boothlink/products/edit-product?prod_id=$prod_id");
            exit();
        }

        $result = $this->editProductsModel->updateProducts($prod_id, $prod_serv_name, $category, $price, $status, $description);

        if ($result) {
            $_SESSION['product_updated'] = true;
            header("Location: /cs-312_boothlink/products");
        } else {
            $_SESSION['product_updated'] = false;
            header("Location: /cs-312_boothlink/products?error=1");
        }
        exit();
    }
}
