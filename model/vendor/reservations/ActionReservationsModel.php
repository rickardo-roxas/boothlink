<?php

include 'model/vendor/VendorQueries.php';

class ActionReservationsModel {
    private $vendorQueries;

    public function __construct() {
        $this->vendorQueries = new VendorQueries();
    }

    public function acceptReservation($reservation_id) {
        return $this->vendorQueries->completeReservation($reservation_id);
    }

    public function rejectReservation($reservation_id) {
        return $this->vendorQueries->cancelReservation($reservation_id);
    }
}
