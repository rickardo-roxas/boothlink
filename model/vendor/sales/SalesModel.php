<?php

if (file_exists('model/vendor/VendorQueries.php'))
    require 'model/vendor/VendorQueries.php';
else {
    require __DIR__ . '/../VendorQueries.php';
}

class SalesModel{

    private $vendorQueries;

    private $orgID;

    private $xyValues;

    private $labels;

    public function __construct() {
        $this->vendorQueries = new VendorQueries();
        $this->orgID = 1;
    }

    public function getProducts(){
        return $this->vendorQueries->getProductSales($this->orgID);
    }

    public function filterCategoryUsing($filter) {
        return $this->vendorQueries->getProductsByCategory($this->orgID, $filter);
    }
    public function filterStatusUsing($filter) {
        return $this->vendorQueries->getProductsByStatus($this->orgID, $filter);
    }

    public function getSalesToday() {
        return $this->vendorQueries->getSalesToday($this->orgID);
    }

    public function getSalesWeek() {
        return $this->vendorQueries->getSalesThisWeek($this->orgID);
    }

    public function definePoints() {
        $array = $this->vendorQueries->getSalesDataPointsForWeek($this->orgID);
        foreach ($array as $point) :
            $this->xyValues[] = $point['amounts'];
            $this->labels[] = $point['dates'];
        endforeach;
        return $array;
    }

    public function getXValues(): ?array {
        return $this->xyValues;
       // return [50,60,70,80,90,100,110,120,130,140,150];
    }

    public function getLabels(): ?array {
        return $this->labels;
       // return ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    }

    /*
    const xValues = [50,60,70,80,90,100,110,120,130,140,150];
    const yValues = [7,8,8,9,9,9,10,11,14,14,15];

    const categoryList = ["item", "service", "food"];

    const perfToday = 289.00;
    const perfWeek = 1384;

    public function getXValues() {
        return self::xValues;
    }
    public function getYValues() {
        return self::yValues;
    }
    public function getCategoryList() {
        return self::categoryList;
    }
    public function getPerfToday() {
        return self::perfToday;
    }
    public function getPerfWeek() {
        return self::perfWeek;
    }
    public function getProductList() {
        $prod1 = new Product("assets/1x1.jpeg", "iPhone 14 Pro Max 512GB (Gold)", 1399, "Item", "1243 pcs", "In Stock");
        $prod2 = new Product("assets/1x1.jpeg", "iPhone 14 Pro Max 512GB (Gold)", 1399, "Item", "1243 pcs", "In Stock");
        return [$prod1, $prod2];
    }
    */


}