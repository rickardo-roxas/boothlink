<?php


namespace controller\vendor\products;

use model\vendor\products\EditProductsModel;


error_reporting(E_ALL);
ini_set('display_errors', 1);

require ('model/products/EditProductsModel.php');

class EditProductsController {
    private $editProductsModel;

    public function __construct() {
        $this->editProductsModel = new EditProductsModel();
    }

    public function index() {
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
    public function delete() {

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
    private function handleGetRequest($prod_id) {
        // Fetch product data
        $productData = $this->editProductsModel->getProductsByID($prod_id);

        if ($productData) {
            // Fetch associated schedule IDs
            $productData['schedule_ids'] = $this->editProductsModel->getProductScheduleIds($prod_id);

            // Pass the data to the view
            require 'view/products/edit_product.php'; // Render the edit form
        } else {
            echo "Product not found.";
            exit();
        }
    }

    // Handle POST request: Update product in the database
    private function handlePostRequest($prod_id) {
        // Collect and sanitize form inputs
        $prod_serv_name = trim($_POST['name'] ?? '');
        $category = $_POST['type'] ?? '';
        $price = floatval($_POST['price'] ?? 0);
        $status = $_POST['status'] ?? '';
        $description = trim($_POST['description'] ?? '');
        $selected_schedule_ids = $_POST['schedule_ids'] ?? []; // array of checked schedId

        // Validate required fields
        if (empty($prod_serv_name) || empty($category) || empty($price) || empty($status) || empty($description)) {
            $_SESSION['error'] = "Please fill in all required fields.";
            header("Location: /cs-312-boothlink/products/edit-product?prod_id=$prod_id");
            exit();
        }

        // Update product details
        $result = $this->editProductsModel->updateProducts($prod_id, $prod_serv_name, $category, $price, $status, $description);

        if ($result)
        {
            // get the current schedule ids from the database
            $current_schedule_ids = $this->editProductsModel->getProductScheduleIds($prod_id);

            // the selected ids to add or remove
            $ids_to_add = array_diff($selected_schedule_ids, $current_schedule_ids);
            $ids_to_remove = array_diff($current_schedule_ids, $selected_schedule_ids);

            //to be passed in the parameter to avoid null
            $org_id = $_SESSION['org_id'] ?? null;

            // add new schedule ids
            foreach ($ids_to_add as $sched_id)
            {
                if (isset($org_id))
                {
                    $this->editProductsModel->addProductSchedule($prod_id, $sched_id, $org_id);
                }
            }

            // for removing unchecked
            foreach ($ids_to_remove as $sched_id) {
                $this->editProductsModel->removeProductSchedule($prod_id, $sched_id, $org_id);
            }

            $_SESSION['product_updated'] = true;
            header("Location: /cs-312_boothlink/products");
        } else {
            $_SESSION['product_updated'] = false;
            header("Location: /cs-312_boothlink/products?error=1");
        }

        exit();
    }

}
