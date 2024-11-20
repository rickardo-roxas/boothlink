<?php

namespace model\vendor\sales;

use model\vendor\VendorQueries;

if (file_exists('model/vendor/VendorQueries.php'))
    require 'model/vendor/VendorQueries.php';
else {
    require __DIR__ . '/../VendorQueries.php';
}

class SalesModel
{

    private $vendorQueries;

    private $orgID;

    private $xyValues;

    private $labels;

    public function __construct()
    {
        $this->vendorQueries = new VendorQueries();

    }

    public function getProducts($org_id)
    {
        return $this->vendorQueries->getProductSales($org_id);
    }

    public function filterCategoryUsing($org_id, $filter)
    {
        return $this->vendorQueries->getProductsByCategory($org_id, $filter);
    }

    public function filterStatusUsing($org_id, $filter)
    {
        return $this->vendorQueries->getProductsByStatus($org_id, $filter);
    }

    public function getSalesToday($org_id)
    {
        return $this->vendorQueries->getSalesToday($org_id);
    }

    public function getSalesWeek($org_id)
    {
        return $this->vendorQueries->getSalesThisWeek($org_id);
    }

    public function definePoints($org_id)
    {
        $array = $this->vendorQueries->getSalesDataPointsForWeek($org_id);
        foreach ($array as $point) :
            $this->xyValues[] = $point['amounts'];
            $this->labels[] = $point['dates'];
        endforeach;
        return $array;
    }

    public function getXValues(): ?array
    {
        return $this->xyValues;
        // return [50,60,70,80,90,100,110,120,130,140,150];
    }

    public function getLabels(): ?array
    {
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