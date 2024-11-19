<?php
class OrgSelectController {
    private $orgSelectModel;

    public function __construct($orgSelectModel) {
        $this->orgSelectModel = $orgSelectModel;
    }

    public function displayOrgSelector() {
        if (!isset($_SESSION['vendor_id'])) {
            echo "Error: vendor_id not set in session.";
            exit();
        }

        $vendor_id = $_SESSION['vendor_id'];
        $organizations = $this->orgSelectModel->getOrganizationsByVendorID($vendor_id);

        if (empty($organizations)) {
            echo "No organizations found for this vendor.";
            exit();
        }

        require_once 'view/vendor/OrgSelectView.php';
    }


}
