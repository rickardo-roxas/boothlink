<?php
include 'model/vendor/home/Home.php';
class HomeController {
    protected $model;

    public function __construct() {
        // You can initialize without org_id here
    }

    /**
     * @throws Exception
     */
    public function index($firstTime) {
        if ($firstTime) {
            if (!isset($_SESSION['org_id'])) {
                // handles the case when org_id is not set
                header('Location: /org_select');
                exit();
            }

            $org_id = $_SESSION['org_id']; // gets the org_id from the session
            $this->model = new Home($org_id); // passes the org_id to the homemodel
            $organizationData = $this->model->getOrganization();

            require_once 'view/vendor/home/home_view.php';
        } else {
            header('Location: home_view.php');
            exit();
        }
    }
}
