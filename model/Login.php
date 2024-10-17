<?php

class Login {
    private $conn;  
    private $vendor_id;
    private $email;
    private $username;
    private $last_name;
    private $first_name;
    private $password;

    public function __construct($db_connection) {
        $this->conn = $db_connection;

        if (!$this->conn) {
            die("Database connection failed.");
        }
    }
    public function authenticate($username, $password) {
        $query = "SELECT vendor_id, email, username, last_name, first_name, password FROM vendor
                  WHERE username = ? LIMIT 1";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("SQL error: " . $this->conn->error);
        }
    
        $stmt->bind_param('s', $username);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
   
            if ($password === $row['password']) {
                return true;
            } else {
                    return false;
            }
        } else {
    
            return false;
        }
    }
    
    public function getUserDetails() {
        return [
            'vendor_id' => $this->vendor_id,
            'email' => $this->email,
            'username' => $this->username,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name
        ];
    }

}