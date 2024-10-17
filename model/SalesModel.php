<?php

class SalesModel{

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
}