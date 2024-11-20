<?php

namespace model\vendor;
require_once 'vendor/model/VendorQueries.php';

class OrgSelectModel
{
    private $vendorQueries;

    public function __construct($vendorQueries)
    {
        $this->vendorQueries = $vendorQueries;
    }

    public function getAllOrganizations()
    {
        $orgs = $this->vendorQueries->getAllOrgs();
        return $orgs;
    }

    public function getOrganizationById($org_id)
    {
        return $this->vendorQueries->getOrgByID($org_id);
    }

    public function getOrganizationsByVendorID($vendor_id)
    {
        return $this->vendorQueries->getOrganizationsByVendorID($vendor_id);
    }

    public function addOrganization($name, $image)
    {
        return $this->vendorQueries->addOrganization($name, $image);
    }
}
