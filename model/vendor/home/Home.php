<?php

require_once 'model/vendor/VendorQueries.php';

class Home {
    /**
     * @var - For database queries.
     */
    private $vendorQueries;

    /**
     * @throws Exception
     */
    public function __construct() {
        $this->vendorQueries = new VendorQueries();
    }

    /**
     * @throws Exception
     */
    public function getOrganization() {
        $org_id = $_SESSION['org_id'];
        $organization = $this->vendorQueries->getOrganizationByID($org_id);

        if ($organization) {
            return $organization;
        } else {
            throw new Exception("Organization not found for ID: $org_id");
        }
    }
}
