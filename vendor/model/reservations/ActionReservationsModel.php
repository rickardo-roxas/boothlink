<?php

namespace model\vendor\reservations;

use model\vendor\VendorQueries;

require_once 'model/VendorQueries.php';

class ActionReservationsModel
{
    private $vendorQueries;

    public function __construct()
    {
        $this->vendorQueries = new VendorQueries();
    }

    public function acceptReservation($customer_id, $reservation_id, $grand_total)
    {
        if ($this->vendorQueries->addSales($customer_id, $reservation_id, $grand_total)) {
            return $this->vendorQueries->completeReservation($reservation_id);
        };
        return false;
    }

    public function rejectReservation($reservation_id)
    {
        return $this->vendorQueries->cancelReservation($reservation_id);
    }
}
