<?php

include ('model/vendor/sales/SalesModel.php');

class SalesController {

    private $model;

    public function __construct() {
        $this->model = new SalesModel();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function index() {

        $products = $this->getModel()->getProducts();
        $salesToday = $this->getModel()->getPerfToday();

// Adding products to the array
      //  $products = [];
        //   $products[] = new Product('path/to/image1.jpg', 'Product One', 29.99, 'Category A', 200, 'Available');
     //   $products[] = new Product('path/to/image2.jpg', 'Product Two', 39.99, 'Category B', 150, 'Sold Out');
      //  $products[] = new Product('path/to/image3.jpg', 'Product Three', 19.99, 'Category A', 300, 'Available');
       // $products[] = new Product('path/to/image4.jpg', 'Product Four', 49.99, 'Category C', 80, 'Available');
      //  $products[] = new Product('path/to/image5.jpg', 'Product Five', 15.99, 'Category B', 500, 'Available');
        require_once 'view/vendor/sales/sales_view.php';
        exit();
    }
}