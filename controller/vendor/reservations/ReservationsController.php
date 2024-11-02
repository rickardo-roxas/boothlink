<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ReservationsController
{
    protected $model;
    protected $sessionID;

    public function __construct() {
        include (__DIR__.'/../../../model/vendor/reservations/ReservationsPageModel.php');

        $this->sessionID = $_SESSION['orgID'];
        $this->model = new ReservationsPageModel();
    }

    public function index(){
        //$reservations = $this->model->getReservations($this->sessionID);
        header('Location: /cs-312_boothlink/view/vendor/reservations/reservations_view.php');
        exit();
    }
}