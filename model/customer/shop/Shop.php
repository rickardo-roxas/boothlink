<?php

class Shop
{

    private $customerQueries;

    public function __construct()
    {
        require_once 'model/customer/CustomerQueries.php';
        $this->customerQueries = new CustomerQueries();
    }
}
