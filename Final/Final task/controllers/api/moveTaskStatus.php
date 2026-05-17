<?php

session_start();

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../models/TaskModel.php";
require_once __DIR__ . "/../../models/ProjectModel.php";
require_once __DIR__ . "/../../config/helpers.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode([
        "ok" => false,
        "message" => "User not logged in"
    ]);
    exit();
}

if (!isset($_POST["task_id"]) || !isset($_POST["status"])) {
    echo json_encode([
        "ok" => false,
        "message" => "Missing task ID or status"
    ]);
    exit();
}

$task_id = $_POST["task_id"];
$new_status = $_POST["status"];

$allowed_status = ["todo", "in-progress", "done"];

if (!in_array($new_status, $allowed_status)) {
    echo json_encode([
        "ok" => false,
        "message" => "Invalid status"
    ]);
    exit();
}

$taskModel = new TaskModel($connection);
$projectModel = new ProjectModel();

$taskResult = $taskModel->getTaskById($task_id);

if (!$taskResult || $taskResult->num_rows == 0) {
    echo json_encode([
        "ok" => false,
        "message" => "Task not found"
    ]);
    exit();
}

$task = $taskResult->fetch_assoc();

$projectResult = $projectModel->getProjectById($connection, $task["project_id"]);

if (!$projectResult || $projectResult->num_rows == 0) {
    echo json_encode([
        "ok" => false,
        "message" => "Project not found"
    ]);
    exit();
}

if ($taskModel->updateTaskStatus($task_id, $new_status)) {

    $statusText = ucfirst(str_replace("-", " ", $new_status));

    log_activity(
        $task["project_id"],
        $_SESSION["user_id"],
        "moved task '" . $task["title"] . "' to " . $statusText
    );

    echo json_encode([
        "ok" => true,
        "message" => "Task moved successfully",
        "new_status" => $new_status
    ]);
    exit();

} else {
    echo json_encode([
        "ok" => false,
        "message" => "Status update failed"
    ]);
    exit();
}

?>