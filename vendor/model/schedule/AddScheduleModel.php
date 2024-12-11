<?php

namespace model\vendor\schedule;

use model\vendor\VendorQueries;

require_once 'model/VendorQueries.php';

class AddScheduleModel
{
    private $vendorQueries;

    public function __construct()
    {
        $this->vendorQueries = new VendorQueries();
    }

    public function addSchedule($org_id, $date, $startTime, $endTime, $loc_id)
    {
        $this->vendorQueries->addSchedule($org_id, $date, $startTime, $endTime, $loc_id);
    }
}
