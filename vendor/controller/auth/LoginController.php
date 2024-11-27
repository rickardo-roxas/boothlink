<?php

namespace controller\auth;

use model\auth\Login;

require_once "./config/Connection.php";
require_once "./model/auth/Login.php";
require_once './view/auth/login_view.php';

class LoginController
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $login = new Login($this->conn);

            if (!isset($_SESSION['loginAttempts'])) {
                $_SESSION['loginAttempts'] = 0;
            }
            if ($_SESSION['loginAttempts'] === 5) {
                $_SESSION['login_error'] = 'You have reached the max number of attempts';
                echo "<script> window.alert('Max Attempts: Clear your Cookies.'); </script>";
                echo "<script>window.location.href = 'http://localhost:3000/login/';</script>";
                exit();
                
            } else if ($login->authenticateVendor($username, $password)) {
                $_SESSION['user'] = $username;
                $_SESSION['vendor_id'] = $login->getUserID($username);

                if (!isset($_SESSION['first_time'])) {
                    $_SESSION['first_time'] = true; // Set first time
                } else {
                    $_SESSION['first_time'] = false; // Not first time
                }
                echo "<script>window.location.href = '/cs-312_boothlink/org_select';</script>";
                exit();
            } else {
                if ($login->authenticateCustomer($username, $password)) {
                    $id = $login->getCustomerID($username);
                    $username = $username;
                    echo "<script>window.location.href = 'http://localhost:3000/login/" . base64_encode($id) . "/" . base64_encode(urlencode($username)) . " ';</script>";
                    exit();
                } else {
                    $_SESSION['loginAttempts'] = $_SESSION['loginAttempts'] +1;
                    //Add a script where an alert will pop up that log in failed, incorrect credentials
                    $_SESSION['login_error'] = 'Invalid username or password';
                    echo "<script> window.alert('Invalid username or password'); </script>";
                    echo "<script>window.location.href = 'http://localhost:3000/login/';</script>";
                    exit();
                }
            }
        }
    }
}
