<?php
$host = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "boothlink";
//uncomment line 6 if using windows
$conn = new mysqli($host, $username, $password, $dbname);

// uncomment line 9-10 if using mac
//$dbname = "boothlink";
//$socket = "/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock";

//uncomment line 13 if using mac
//$conn = new mysqli($host, $username, $password, $dbname, null, $socket);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
