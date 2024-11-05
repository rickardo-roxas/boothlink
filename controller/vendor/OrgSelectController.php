<?php
class OrgSelectController {
    private $orgSelectModel;

    public function __construct($orgSelectModel) {
        $this->orgSelectModel = $orgSelectModel;
    }

    public function displayOrgSelector() {
        // Retrieve list of organizations
        $organizations = $this->orgSelectModel->getAllOrganizations();
        include 'view/vendor/OrgSelectView.php';
    }

    public function selectOrganization($org_id) {
        $_SESSION['org_id'] = $org_id;
        header('Location: /home');
        exit();
    }

}
