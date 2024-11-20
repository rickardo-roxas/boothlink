<?php

namespace controller\auth;

use model\auth\Login;

require_once "vendor/config/Connection.php";
require_once "vendor/model/auth/Login.php";
require_once 'vendor/view/auth/login_view.php';

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
            if ($login->authenticateVendor($username, $password)) {
                $_SESSION['user'] = $username;
                $_SESSION['vendor_id'] = $login->getUserID($username);

                if (!isset($_SESSION['first_time'])) {
                    $_SESSION['first_time'] = true; // Set first time
                } else {
                    $_SESSION['first_time'] = false; // Not first time
                }
                header("Location: /cs-312_boothlink/org_select");
                exit();
            } else {
                if ($login->authenticateCustomer($username, $password)) {
                    $id = $login->getCustomerID($username);
                    $username = $username;
                    header("Location: http://localhost:3000/" . $id . "/" . urlencode($username));
                    exit();
                } else {
                    //Add a script where an alert will pop up that log in failed, incorrect credentials
                    $_SESSION['login_error'] = 'Invalid username or password'
                    header("Location: /login");
                    exit();
                }

            }
        }
    }
}
