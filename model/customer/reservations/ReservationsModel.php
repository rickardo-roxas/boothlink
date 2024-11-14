<?php

class ReservationsModel
{
    private $customerQueries;

    public function __construct() {
        include 'model/customer/CustomerQueries.php';
        $this->customerQueries = new CustomerQueries;
    }
}
