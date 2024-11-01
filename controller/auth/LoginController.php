<?php
include "config/Connection.php";
include 'view/vendor/login_view.php';
include 'controller/PageHandler.php';

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
                $_SESSION['user'] = "ramon";


                $handler = new PageHandler();
                exit();        
    
            } else {
                // echo "Login failed! Invalid username or password.";
            }
        }
    }
}
