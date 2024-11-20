<?php

namespace model\vendor\sales;
require_once 'vendor/model/VendorQueries.php';

class SalesFilter
{

    private $filter;
    private $queries;

    public function __construct()
    {
        $this->filter = $_GET['filter'];
        $this->queries = new VendorQueries();
        $this->queries->getProductsFiltered($this->filter);
    }
}