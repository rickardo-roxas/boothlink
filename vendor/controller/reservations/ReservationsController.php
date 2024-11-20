<?php

namespace controller\vendor\reservations;

use model\vendor\reservations\ReservationsPageModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('vendor/model/reservations/ReservationsPageModel.php');

if (isset($_GET['status'])) {
    $filter = $_GET['status'];
    $controller = new ReservationsController();
    $controller->filterStatus($filter);
}

class ReservationsController
{
    private $model;

    public function __construct()
    {
        $this->model = new ReservationsPageModel();
    }

    public function index()
    {
        $org_id = $_SESSION['org_id'];
        $dateToday = date("Y-m-d");

        $reservations = $this->model->getReservations($org_id);

        require_once 'vendor/view/reservations/reservations_view.php';
        exit();
    }

    public function filterStatus($filter)
    {
        $org_id = $_SESSION['org_id'];
        $reservations = $this->model->getReservationsByStatus($org_id, $filter);

        require 'vendor/view/reservations/reservations_view.php';
    }
}