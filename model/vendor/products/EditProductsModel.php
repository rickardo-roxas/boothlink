<?php

class EditProductsModel {
    private $vendorQueries;

    public function __construct() {
        include 'model/vendor/VendorQueries.php';
        $this->vendorQueries = new VendorQueries();
    }

    // Fetch product by ID
    public function getProductsByID($prod_id) {
        return $this->vendorQueries->getProductsByID($prod_id);
    }

    public function updateProducts($prod_id, $name, $type, $price, $status, $description) {
        return $this->vendorQueries->updateProduct($prod_id, $name, $type, $price, $status, $description);
    }

    public function deleteProducts($prod_id){
        return $this->vendorQueries->deleteProduct($prod_id);
    }
}