<?php
class Connection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "boothlink"; 
    private $conn;

    public function getConnection() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
