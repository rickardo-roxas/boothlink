<?php

namespace model\vendor\products;

use model\vendor\VendorQueries;

class EditProductsModel
{
    private $vendorQueries;

    public function __construct()
    {
        require_once 'vendor/model/VendorQueries.php';
        $this->vendorQueries = new VendorQueries();
    }

    // Fetch product by ID
    public function getProductsByID($prod_id)
    {
        return $this->vendorQueries->getProductsByID($prod_id);
    }

    public function updateProducts($prod_id, $name, $type, $price, $status, $description)
    {
        return $this->vendorQueries->updateProduct($prod_id, $name, $type, $price, $status, $description);
    }

    public function deleteProducts($prod_id)
    {
        return $this->vendorQueries->deleteProduct($prod_id);
    }
}
