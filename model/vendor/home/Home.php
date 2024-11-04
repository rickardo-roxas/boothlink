<?php

require_once 'model/vendor/VendorQueries.php';

class Home {
    /**
     * @var - For database queries.
     */
    private $vendorQueries;
    private $org_id;

    /**
     * Constructor accepting org_id
     * @param int $org_id
     * @throws Exception
     */
    public function __construct($org_id) {
        $this->vendorQueries = new VendorQueries();
        $this->org_id = $org_id;
    }

    /**
     * @throws Exception
     */
    public function getOrganization() {
        $organization = $this->vendorQueries->getOrganizationByID($this->org_id);

        if ($organization) {
            return $organization;
        } else {
            throw new Exception("Organization not found for ID: {$this->org_id}");
        }
    }
}
