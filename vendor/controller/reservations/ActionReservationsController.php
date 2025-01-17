<?php

namespace controller\vendor\reservations;

use model\vendor\reservations\ActionReservationsModel;

error_reporting(E_ALL);
ini_set("display_errors", 1);

include 'model/reservations/ActionReservationsModel.php';

class ActionReservationsController
{
    private $actionReservationsModel;

    public function __construct()
    {
        $this->actionReservationsModel = new ActionReservationsModel();
    }

    public function completeReservation()
    {
        $reservation_id = $_GET['reservation_id'] ?? $_POST['reservation_id'] ?? null;
        $customer_id = $_GET['customer_id'] ?? $_POST['customer_id'] ?? null;
        $grand_total = $_GET['grand_total'] ?? $_POST['grand_total'] ?? null;

        if ($reservation_id != null) {
            $result = $this->actionReservationsModel->acceptReservation($customer_id, $reservation_id, $grand_total);
            if ($result) {
                header('location: /cs-312_boothlink/reservations');
            } else {
                header('location: /cs-312_boothlink/reservations?error=1');

            }
        }
    }

    public function rejectReservation()
    {
        $reservation_id = $_GET['reservation_id'] ?? $_POST['reservation_id'] ?? null;
        if ($reservation_id != null) {
            $result = $this->actionReservationsModel->rejectReservation($reservation_id);
            if ($result) {
                header('location: /cs-312_boothlink/reservations');
                exit();
            } else {
                header('location: /cs-312_boothlink/reservations?error=2');
                exit();
            }
        }
    }
}


