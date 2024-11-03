<?php

require_once "config/Connection.php";
require_once "model/vendor/home/Home.php";


class HomeController {
    protected $model;

    public function __construct() {
        $this->model = new Home();
    }

    /**
     * @throws Exception
     */
    public function index($firstTime) {
        if ($firstTime) {
            $organizationData = $this->model->getOrganization();

            require_once 'view/vendor/home/home_view.php';
        } else {
            header('Location: home_view.php');
        }
        exit();
    }
}

