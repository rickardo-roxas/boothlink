<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('model/vendor/reservations/ReservationsPageModel.php');


class ReservationsController
{
    private $model;

    public function __construct() {
        $this->model = new ReservationsPageModel();
    }

    public function index(){
        $org_id = $_SESSION['org_id'];
        $dateToday = date("Y-m-d");

        $reservations = $this->model->getReservations($org_id, $dateToday);

        require_once 'view/vendor/reservations/reservations_view.php';
        exit();
    }
}