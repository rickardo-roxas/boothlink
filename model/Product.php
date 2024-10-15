<?php

class Product {

    public $image;
    public $name;
    public $price;
    public $category;
    public $sold;
    public $status;

    public function __construct($image ="null", $name ="null", $price = 0.0, $category = "item", $sold = 5.5, $status= "pending") {
        $this -> image = $image;
        $this -> name = $name;
        $this -> price = $price;
        $this -> category = $category;
        $this -> sold = $sold;
        $this -> status = $status;
    }

    public function getImage() {
        return $this -> image;
    }

    public function getName() {
        return $this -> name;
    }

    public function getPrice() {
        return $this -> price;
    }

    public function getCategory() {
        return $this -> category;
    }

    public function getSold() {
        return $this -> sold;
    }

    public function getStatus() {
        return $this -> status;
    }
}