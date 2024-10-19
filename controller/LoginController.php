<?php
include "Connection.php";
include 'view/LoginView.php';

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
                new DashboardController($username);
                exit();        
    
            } else {
                echo "Login failed! Invalid username or password.";
            }
        }
    }
}
