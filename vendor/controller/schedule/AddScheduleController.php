<?php

namespace controller\vendor\schedule;

use model\vendor\schedule\AddScheduleModel;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'model/schedule/AddScheduleModel.php';

class AddScheduleController
{
    private $model;

    public function __construct()
    {
        $this->model = new AddScheduleModel();
    }

    public function addSchedule()
    {
        $org_id = $_SESSION['org_id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $date = $_POST["date"];
            $startTime = $_POST["start-time"];
            $endTime = $_POST["end-time"];
            $loc_id = 1;

            // Call the model to add the schedule
            $this->model->addSchedule($org_id, $date, $startTime, $endTime, $loc_id);
            header("Location: /cs-312_boothlink/schedule");
            exit();
        }
    }
}
