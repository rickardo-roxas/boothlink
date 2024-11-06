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
    public function getReservations($org_id): array {
        $reservation = $this->vendorQueries->getReservations($org_id);
        $reservations = [];

        if ($reservation) {
            foreach ($reservation as $reservation) {
                $reservations[] = $reservation->toArray();
            }
        }

        return $reservations;
    }

    public function getReservationsByStatus($org_id, $status): array {
        $reservations = $this->vendorQueries->getReservationsByStatus($org_id, $status);
        $result = [];

        if ($reservations) {
            foreach ($reservations as $reservation) {
                $result[] = $reservation->toArray();
            }
        }

        return $result;
    }
}