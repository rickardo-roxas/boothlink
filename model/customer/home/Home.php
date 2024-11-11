<?php

require_once 'model/customer/CustomerQueries.php';
class Home {

    private $customerQueries;

    public function __construct() {
        $this ->customerQueries = new CustomerQueries();
    }
}
