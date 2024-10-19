<?php

class ScheduleController {
    private $model;

    public function __construct() {
        include(__DIR__.'/../model/Schedule.php');
        $this->model = new Schedule();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function index() {
        header('Location: ScheduleView.php');
        exit();
    }
}
