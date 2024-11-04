<?php
require_once 'model/vendor/VendorQueries.php';

class AddNewProductModel{
    private $vendorQueries;

    public function __construct(){
        $this->vendorQueries = new VendorQueries();
    }

    public function addProduct($org_id, $status, $category, $prod_serv_name, $price, $description, $image_src){
        $this->vendorQueries->addProduct($org_id, $status, $category, $prod_serv_name, $price, $description, $image_src);
    }
}