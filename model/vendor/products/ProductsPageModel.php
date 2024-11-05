<?php
require_once 'model/vendor/VendorQueries.php';

class ProductsPageModel{
    private $vendorQueries;

    public function __construct(){
        $this->vendorQueries = new VendorQueries();
    }

    public function getProducts($org_id){
        $result = $this->vendorQueries->getProducts($org_id);

        $products = [];

        if($result){
            $products = $result->fetch_all(MYSQLI_ASSOC);
        }

        return $products;
    }

    public function getFilteredProducts($org_id, $filter){
        return $this->vendorQueries->getProductsByCategory($org_id, $filter);
    }
}