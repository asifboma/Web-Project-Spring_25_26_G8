<?php
require_once __DIR__ . '/../config/db.php';

class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Add model methods here.
}
?>
