<?php
require_once "config/Connection.php";
require_once "model/auth/Login.php";
require_once 'view/auth/login_view.php';

class LoginController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $login = new Login($this->conn);
            if ($login->authenticate($username, $password)) {
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
                echo "Login failed! Invalid username or password.";
            }
        }
    }
}
