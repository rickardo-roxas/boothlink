<?php

namespace model\vendor\products;

use model\vendor\VendorQueries;

require_once 'vendor/model/VendorQueries.php';

class AddNewProductModel
{
    private $vendorQueries;

    public function __construct()
    {
        $this->vendorQueries = new VendorQueries();
    }

    public function addProduct($org_id, $status, $category, $prod_serv_name, $price, $description, $image_src,$selected_schedule_ids)
    {
        $this->vendorQueries->addProduct($org_id, $status, $category, $prod_serv_name, $price, $description, $image_src, $selected_schedule_ids);
    }


    public function getSchedule()
    {
        return $this->vendorQueries->getAllScheduleByWeek();
    }
}