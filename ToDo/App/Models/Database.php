<?php

class Database {
    private $connection;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "todo";

        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $conn;
    }

    public function get():PDO {
        return $this->connection;
    }
}
?>