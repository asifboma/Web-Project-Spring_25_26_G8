<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "project8_db";

    public function connection() {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>