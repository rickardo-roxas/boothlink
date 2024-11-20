<?php

namespace controller\vendor\schedule;

use DateTime;
use model\vendor\schedule\SchedulePageModel;

class ScheduleController
{
    private $model;

    public function __construct()
    {
        include('vendor/model/schedule/SchedulePageModel.php');
        $this->model = new SchedulePageModel();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function index()
    {
        $org_id = $_SESSION['org_id'];

        date_default_timezone_set('Asia/Manila');

        $today = new DateTime();

        $monday = clone $today;
        $saturday = clone $today;

        $monday->modify('monday this week');
        $saturday->modify('saturday this week');

        $startDate = $monday->format('F j');
        $startDateRange = $monday->format('Y-m-d');

        $endDate = $saturday->format('F j');
        $endDateRange = $saturday->format('Y-m-d');

        $year = $today->format('Y');

        $dateRange = "$startDate - $endDate ($year)";

        $scheduleThisWeek = $this->model->getScheduleThisWeek($org_id, $startDateRange, $endDateRange);

        require_once 'vendor/view/schedule/schedule_view.php';
        exit();
    }
}
