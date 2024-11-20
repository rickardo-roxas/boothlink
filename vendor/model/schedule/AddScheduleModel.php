<?php

namespace model\vendor\schedule;

use model\vendor\VendorQueries;

require_once 'vendor/model/VendorQueries.php';

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

    public function getSchedules($org_id, $date, $startTime, $endTime, $loc_id)
    {
        return $this->vendorQueries->getSchedules($org_id, $date, $startTime, $endTime);
    }

    public function getSchedule($org_id, $date, $startTime, $endTime, $loc_id)
    {
        return $this->vendorQueries->getSchedule($org_id, $date, $startTime, $endTime, $loc_id);
    }
}
