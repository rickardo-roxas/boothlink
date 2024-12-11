<?php

namespace model\vendor\home;

use model\vendor\VendorQueries;

require_once 'model/VendorQueries.php';

class Home
{
    /**
     * @var - For database queries.
     */
    private $vendorQueries;

    /**
     * Constructor accepting org_id
     * @throws Exception
     */
    public function __construct()
    {
        $this->vendorQueries = new VendorQueries();
    }

    /**
     * @throws Exception
     */
    public function getOrganization($org_id): array
    {
        $organization = $this->vendorQueries->getOrganizationByID($org_id);

        if ($organization) {
            return $organization->toArray();
        } else {
            throw new Exception("Organization not found.");
        }
    }


    public function getRecentReservations($org_id): array
    {
        $reservation = $this->vendorQueries->getRecentReservations($org_id);
        $reservations = [];

        if ($reservation) {
            foreach ($reservation as $reservation) {
                $reservations[] = $reservation->toArray();
            }
        }
        return $reservations;
    }

    /**
     * @throws Exception
     */
    public function getScheduleToday($org_id, $date): array
    {
        $schedule = $this->vendorQueries->getScheduleToday($org_id, $date);
        $schedules = [];

        if ($schedule) {
            foreach ($schedule as $schedule) {
                $schedules[] = $schedule->toArray();
            }
        }

        return $schedules;
    }

    public function getSalesToday($org_id)
    {
        $salesToday = $this->vendorQueries->getSalesToday($org_id);


        return $salesToday;
    }

    public function getSalesThisWeek($org_id)
    {
        $sales = $this->vendorQueries->getSalesThisWeek($org_id);

        return $sales;
    }

    public function getPendingReservations($org_id)
    {
        $pendingReservations = $this->vendorQueries->getPendingReservationsCount($org_id);


        return $pendingReservations;
    }

    public function getCompletedReservations($org_id)
    {
        $completedReservations = $this->vendorQueries->getCompletedReservationsCount($org_id);

        return $completedReservations;
    }

    public function getTotalReservations($org_id)
    {
        $totalReservations = $this->vendorQueries->getTotalReservationsCount($org_id);
        return $totalReservations;
    }

    public function getItemReservations($org_id)
    {
        $itemReservations = $this->vendorQueries->getItemReservationsCount($org_id);
        return $itemReservations;
    }

    public function getFoodReservations($org_id)
    {
        $foodReservations = $this->vendorQueries->getFoodReservationsCount($org_id);
        return $foodReservations;
    }

    public function getServiceReservations($org_id, $date)
    {
        $serviceReservations = $this->vendorQueries->getServiceReservationsCount($org_id, $date);
        return $serviceReservations;
    }
}
