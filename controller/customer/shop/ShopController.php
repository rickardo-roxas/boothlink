<?php

class ShopController
{

    private $model;

    public function __construct()
    {
        require_once 'model/customer/shop/Shop.php';
        $this->model = new Shop();
    }

    public function index()
    {

    }
}
