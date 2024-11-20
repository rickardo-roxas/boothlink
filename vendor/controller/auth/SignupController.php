<?php

namespace controller\auth;


require_once "vendor/config/Connection.php";
// require_once "vendor/model/auth/Signup.php";
require_once 'vendor/view/auth/signup_view.php';

class SignupController
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleSignup() {
        // code here
        require_once 'vendor/view/auth/signup_view.php';

    }

}
