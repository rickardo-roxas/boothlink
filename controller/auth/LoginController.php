<?php
require_once "config/Connection.php";
require_once "model/auth/Login.php";
require_once 'view/auth/login_view.php';
include 'controller/vendor/core/PageHandler.php';

class LoginController {
    private $conn;

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
                $handler = new PageHandler();
                exit();        
    
            } else {
                // echo "Login failed! Invalid username or password.";
            }
        }
    }
}
