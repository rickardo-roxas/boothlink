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

    public function getUserID($username) {
        $query = "SELECT vendor_id FROM vendor WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("SQL error: " . $this->conn->error);
        }

        $stmt->bind_param('s', $username);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        // Check if a user was found and return the ID
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['vendor_id']; // Return the vendor_id directly
        }

        return null; // No user found
    }

    public function getOrgID($username) {
        $userID = $this->getUserID($username);

        if ($userID === null) {
            return null; // No user found, return null
        }

        $query = "SELECT org_id FROM vendor_org WHERE vendor_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("SQL error: " . $this->conn->error);
        }

        $stmt->bind_param('i', $userID);
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        // Check if an organization ID was found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['org_id']; // Return the org_id directly
        }

        return null; // No organization found
    }

    public function getUserDetails() {
        return [
            'email' => $this->email,
            'username' => $this->username
        ];
    }
}
