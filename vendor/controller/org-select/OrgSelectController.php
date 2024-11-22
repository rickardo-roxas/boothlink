<?php
namespace controller\vendor;
use model\vendor\OrgSelectModel;

require_once 'model/org-select/OrgSelectModel.php';

class OrgSelectController
{
    private $orgSelectModel;

    public function __construct()
    {
        $this->orgSelectModel = new OrgSelectModel();
    }

    public function displayOrgSelector()
    {
        if (!isset($_SESSION['vendor_id'])) {
            echo "Error: vendor_id not set in session.";
            exit();
        }

        $vendor_id = $_SESSION['vendor_id'];
        $organizations = $this->orgSelectModel->getOrganizationsByVendorID($vendor_id);

        require_once 'view/org-select/org_select_view.php';
    }


    public function selectOrganization($org_id)
    {
        $_SESSION['org_id'] = $org_id;
        header('Location: /home');
        exit();
    }
}
