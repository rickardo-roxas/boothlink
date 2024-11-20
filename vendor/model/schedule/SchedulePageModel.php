<?php

namespace model\vendor\schedule;

use model\vendor\VendorQueries;

require_once 'model/vendor/VendorQueries.php';

class SchedulePageModel
{
    private $vendorQueries;

    public function __construct()
    {
        $this->vendorQueries = new VendorQueries();
    }

    public function getScheduleThisWeek($org_id, $startDate, $endDate)
    {
        return $this->vendorQueries->getScheduleThisWeek($org_id, $startDate, $endDate);
    }
}
