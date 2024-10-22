<?php

require_once 'VendorQueries.php';

class EditProduct {
    private $prod_serve_id;
    private $vendorQueries;

    public function __construct() {
        $this->vendorQueries = new VendorQueries();
    }

    public function getProdId($prod_serve_id) {
        $this->prod_serve_id = $prod_serve_id;
        return $this->vendorQueries->getProductByID($this->prod_serve_id);
    }


}

$editProduct = new EditProduct();
$product = $editProduct->getProdId(1); // Replace 123 with the actual product ID

print ($product);



