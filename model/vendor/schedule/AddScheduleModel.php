<?php

require_once './model/vendor/VendorQueries.php';

class AddScheduleModel {
    private $vendorQueries;

    public function __construct() {
        $this->vendorQueries = new VendorQueries();
    }

    public function addSchedule($date, $startTime, $endTime, $loc_id) {
        $this->vendorQueries->addSchedule($date, $startTime, $endTime, $loc_id);
    }
}
