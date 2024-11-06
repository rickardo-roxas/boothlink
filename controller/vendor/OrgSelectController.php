<?php
class OrgSelectController {
    private $orgSelectModel;

    public function __construct($orgSelectModel) {
        $this->orgSelectModel = $orgSelectModel;
    }

//    public function displayOrgSelector() {
//        // Retrieve list of organizations
//        $organizations = $this->orgSelectModel->getAllOrganizations();
//        include 'view/vendor/OrgSelectView.php';
//    }x
//    // Organization selection controller (e.g., OrgSelectController.php)
    public function displayOrgSelector() {
        if (!isset($_SESSION['vendor_id'])) {
            echo "Error: vendor_id not set in session.";
            exit();
        }

        $vendor_id = $_SESSION['vendor_id'];
        $organizations = $this->orgSelectModel->getOrganizationsByVendorID($vendor_id);

        require_once 'view/vendor/OrgSelectView.php';
    }


    public function selectOrganization($org_id) {
        $_SESSION['org_id'] = $org_id;
        header('Location: /home');
        exit();
    }

}
