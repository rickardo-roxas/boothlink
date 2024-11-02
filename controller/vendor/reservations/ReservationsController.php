<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class ReservationsController
{
    protected $model;

    public function __construct() {
        include (__DIR__.'/../../../model/vendor/reservations/ReservationsPageModel.php');

        $this->model = new ReservationsPageModel();
    }

    public function index(){
        //$reservations = $this->model->getReservations($this->sessionID);
        require_once (__DIR__.'/../../../model/vendor/reservations/ReservationsPageModel.php');
        exit();
    }
}