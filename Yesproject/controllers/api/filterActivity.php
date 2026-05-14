<?php
require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../models/ActivityModel.php";
require_once __DIR__ . "/../../config/helpers.php";

session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["ok" => false, "message" => "Unauthorized"]);
    exit();
}

$project_id = $_GET["project_id"];

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];
} else {
    $user_id = "";
}

$database = new Database();
$conn = $database->connection();

$activityModel = new ActivityModel($conn);

$activities = $activityModel->getActivities($project_id, $user_id);

$data = [];

while ($activity = $activities->fetch_assoc()) {
    $data[] = [
        "name" => $activity["name"],
        "initial" => strtoupper(substr($activity["name"], 0, 1)),
        "action_text" => $activity["action_text"],
        "time_ago" => timeAgo($activity["created_at"])
    ];
}

echo json_encode([
    "ok" => true,
    "activities" => $data
]);
?>