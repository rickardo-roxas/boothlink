<?php
require_once 'model/vendor/VendorQueries.php';

class ReservationsPageModel {
    private $vendorQueries;

    public function __construct() {
        $this->vendorQueries = new VendorQueries();
    }
    /**
     * Retrieves the reservations of a specified organization
     */
    public function getReservations($org_id) {
        $result = $this->vendorQueries->getReservations($org_id);
        $reservations = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reservations[] = $row;
            }
        }

        return $reservations;
    }
}