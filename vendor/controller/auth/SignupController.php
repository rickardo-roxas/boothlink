<?php

namespace controller\auth;


require_once "config/Connection.php";
// require_once "model/auth/Signup.php";
require_once 'view/auth/signup_view.php';

class SignupController
{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleSignup() {
        // code here
        require_once 'view/auth/signup_view.php';

    }

}
