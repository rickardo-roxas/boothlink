<?php
require_once 'model/Connection.php'; 
require_once 'model/Login.php';       
require_once 'view/LoginView.php';    
class LoginController {
    private $db;

    // Constructor to receive database connection
    public function __construct($db) {
        $this->db = $db;
    }

    public function handleLogin() {
        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            // Connect to the database
            $connection = new Connection();
            $db = $connection->getConnection();
        
            // Login model
            $login = new Login($db);
        
            if ($login->authenticate($username, $password)) {
            //    header("location: controller/HelloController.php");
            header("location: view/ProductsPageView.html");
                exit(); 
            } else {
                echo "Login failed! Invalid username or password.";
            }
        }
    }

 
}