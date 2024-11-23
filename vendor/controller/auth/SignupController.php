<?php

namespace controller\auth;

use model\vendor\SignUp;

require_once "vendor/config/Connection.php";
require_once "vendor/model/auth/SignUp.php";

class SignupController {
    protected $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->model = new SignUp($conn);
    }

    public function handleSignup() {
        include 'vendor/view/auth/signup_view.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $last_name = $_POST['last_name'];
            $first_name = $_POST['first_name'];
            $email = $_POST['email'];
            try {
                $success = $this->model->createAccount($email, $username,$last_name, $first_name, $password);
                if ($success) {
                    header('Location: /cs-312_boothlink/login');
                } else {
                    echo "Error creating account.";
                }
            } catch (\Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }
}
