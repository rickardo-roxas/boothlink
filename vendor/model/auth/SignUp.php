<?php
namespace model\vendor;
require_once 'model/VendorQueries.php';

class SignUp {
    private $conn;
    private $vendorQueries;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->vendorQueries = new VendorQueries($conn);
    }

    public function createAccount($username, $email, $password, $last_name, $first_name)
    {
        return $this->vendorQueries->createAccount($username, $email, $password, $last_name, $first_name);
    }
    public function checkEmail($email){
        return $this->vendorQueries->checkEmail($email);
    }
    public function checkUsername($username){
        return $this->vendorQueries->checkUsername($username);
    }
}
