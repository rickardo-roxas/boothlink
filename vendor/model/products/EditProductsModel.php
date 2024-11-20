<?php

namespace model\vendor\products;

use vendor\model\VendorQueries;
require_once('vendor/model/VendorQueries.php');
class EditProductsModel {
    private $vendorQueries;

    public function __construct() {


        $this->vendorQueries = new VendorQueries();
    }

    public function getProductsByID($prod_id) {
        return $this->vendorQueries->getProductsByID($prod_id);
    }

    public function updateProducts($prod_id, $name, $type, $price, $status, $description) {
        return $this->vendorQueries->updateProduct($prod_id, $name, $type, $price, $status, $description);
    }

    public function deleteProducts($prod_id) {
        return $this->vendorQueries->deleteProduct($prod_id);
    }

    public function getSchedule() {
        return $this->vendorQueries->getAllScheduleByWeek();
    }

    public function getProductScheduleIds($prod_id) {
        return $this->vendorQueries->getProductScheduleIds($prod_id);
    }

    public function addProductSchedule($prod_id, $sched_id) {
        return $this->vendorQueries->addProductSchedule($prod_id, $sched_id);
    }

    public function removeProductSchedule($prod_id, $sched_id) {
        return $this->vendorQueries->removeProductSchedule($prod_id, $sched_id);
    }
}
