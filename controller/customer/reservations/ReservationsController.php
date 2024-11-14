<?php

class ReservationsController
{
    private $model;
    public function __construct()
    {
        require_once 'model/customer/reservations/ReservationsModel.php';
        $this->model = new ReservationsModel();
    }
}
