<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../config/session.php';

header('Content-Type: application/json');

echo json_encode([
    "success" => false,
    "message" => "Task 4 API: filter activity feed not implemented yet"
]);
?>
