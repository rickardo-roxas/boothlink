<?php

class ScheduleController {
    private $model;

    public function __construct() {
        include(__DIR__.'/../../../model/vendor/schedule/Schedule.php');
        $this->model = new Schedule();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function index() {
        header('Location: /cs-312_boothlink/view/vendor/schedule/schedule_view.php');
        exit();
    }
}
