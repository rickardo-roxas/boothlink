<?php

class Login {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function authenticate($username, $password) {
        $query = "SELECT email, username, password FROM vendor WHERE username = ? LIMIT 1";

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
            'email' => $this->email,
            'username' => $this->username
        ];
    }
}
