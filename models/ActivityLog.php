<?php
require_once __DIR__ . '/../config/db.php';

class ActivityLog {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Add model methods here.
}
?>
