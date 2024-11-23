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
        $isSignupSuccessful = false;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $last_name = $_POST['last_name'];
            $first_name = $_POST['first_name'];
            $email = $_POST['email'];

            try {
                if ($this->model->checkUsername($username)) {
                    $error = "Username is already taken. Please choose another.";
                } elseif ($this->model->checkEmail($email)) {
                    $error = "Email is already registered. Please use another email.";
                } else {
                $success = $this->model->createAccount($email, $username, $last_name, $first_name, $password);
                if ($success) {
                    $isSignupSuccessful = true;
                } else {
                    $error = "Error creating account.";
                }
                }
            } catch (\Exception $e) {
                $error = "An error occurred: " . $e->getMessage();
            }
        }
        include 'vendor/view/auth/signup_view.php';
    }

}
