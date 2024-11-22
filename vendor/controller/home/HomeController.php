<?php

namespace controller\vendor\home;

use model\vendor\home\Home;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "model/home/Home.php";

class HomeController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Home();
    }

    /**
     * @throws Exception
     */
    public function index($firstTime)
    {
        if ($firstTime) {
            if (!isset($_SESSION['org_id'])) {
                echo "Error: Session ID is not valid.";
                exit;
            }

            $org_id = $_SESSION['org_id'];
            $dateToday = date("Y-m-d");

            $organizationData = $this->model->getOrganization($org_id);
            $recentReservations = $this->model->getRecentReservations($org_id, $dateToday);
            $scheduleToday = $this->model->getScheduleToday($org_id, $dateToday);
            $salesToday = $this->model->getSalesToday($org_id);
            $salesThisWeek = $this->model->getSalesThisWeek($org_id);
            $pendingReservations = $this->model->getPendingReservations($org_id, $dateToday);
            $totalReservations = $this->model->getTotalReservations($org_id, $dateToday);
            $completedReservations = $this->model->getCompletedReservations($org_id, $dateToday);
            $itemReservations = $this->model->getItemReservations($org_id, $dateToday);
            $foodReservations = $this->model->getFoodReservations($org_id, $dateToday);
            $serviceReservations = $this->model->getServiceReservations($org_id, $dateToday);

            require_once 'view/home/home_view.php';
        } else {
            header('Location: home_view.php');
            exit();
        }
    }
}
