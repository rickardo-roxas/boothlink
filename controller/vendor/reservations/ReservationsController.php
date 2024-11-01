<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../model/ReservationsPageModel.php');

class ReservationsPageController {
    private $model;
    private $sessionID;

    public function __construct() {
        $this->sessionID = $_SESSION['orgID'];
        $this->model = new ReservationsPageModel();
    }

    public function index(){
        //$reservations = $this->model->getReservations($this->sessionID);
        header('Location: reservations_view.php');
       // header('Location: ReservationsPageView.php?reservations=' . urlencode(serialize($reservations)));
    }
}