<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__.'/../../../model/vendor/reservations/ReservationsPageModel.php');


class ReservationsController
{
    private $model;
    private $sessionID;

    public function __construct() {
        $this->sessionID = $_SESSION['org_id'];
        $this->model = new ReservationsPageModel();

        if (isset($_SESSION['org_id'])) {
            $this->sessionID = $_SESSION['org_id'];
        } else {
            echo "Error: 'orgID' is not set in the session.";
            exit();
        }

    }

    public function index(){
        require_once 'view/vendor/reservations/reservations_view.php';
        exit();
    }
}