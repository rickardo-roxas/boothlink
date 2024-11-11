<?php

class OrdersController
{
    private $model;
    public function __construct()
    {
        require_once 'model/customer/orders/Orders.php';
        $this->model = new Orders();
    }
}
