<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './model/vendor/schedule/AddScheduleModel.php';

class AddScheduleController
{
    private $model;

    public function __construct() {
        $this->model = new AddScheduleModel();
    }

    public function index() {

    }
}
