<?php

require_once 'model/vendor/OrgSelectModel.php'; 
class OrgSelectController {
    private $orgSelectModel;

    public function __construct($orgSelectModel) {
        $this->orgSelectModel = $orgSelectModel;
    }

    public function displayOrgSelector() {
        $organizations = $this->orgSelectModel->getAllOrganizations();
        include 'view/vendor/OrgSelectView.php'; 
    }
}



