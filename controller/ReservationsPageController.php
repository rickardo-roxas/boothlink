<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../model/ReservationsPageModel.php');

class ReservationsPageController {
    private $model;

    public function __construct() {
        $this->model = new ReservationsPageModel();
    }

    public function showReservations($org_id) {
        $reservations = $this->model->getReservations($org_id);

        include("../view/vendor/ReservationsView.php");
    }
}