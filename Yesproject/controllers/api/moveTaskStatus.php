<?php
require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../models/TaskModel.php";
require_once __DIR__ . "/../../models/ProjectModel.php";
require_once __DIR__ . "/../../config/helpers.php";

session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["workspace_id"])) {
    echo json_encode(["ok" => false, "message" => "Unauthorized"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST["task_id"];
    $new_status = $_POST["status"];

    $allowedStatuses = ["todo", "in-progress", "done"];

    if (!in_array($new_status, $allowedStatuses)) {
        echo json_encode(["ok" => false, "message" => "Invalid status"]);
        exit();
    }

    $database = new Database();
    $conn = $database->connection();

    $taskModel = new TaskModel($conn);
    $projectModel = new ProjectModel($conn);

    $taskResult = $taskModel->getTaskById($task_id);

    if ($taskResult->num_rows == 0) {
        echo json_encode(["ok" => false, "message" => "Task not found"]);
        exit();
    }

    $task = $taskResult->fetch_assoc();

    $projectResult = $projectModel->getProjectById($task["project_id"]);

    if ($projectResult->num_rows == 0) {
        echo json_encode(["ok" => false, "message" => "Project not found"]);
        exit();
    }

    $project = $projectResult->fetch_assoc();

    if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
        echo json_encode(["ok" => false, "message" => "Not allowed"]);
        exit();
    }

    $current_status = $task["status"];

    $validTransition = false;

    if ($current_status == "todo" && $new_status == "in-progress") {
        $validTransition = true;
    }

    if ($current_status == "in-progress" && ($new_status == "todo" || $new_status == "done")) {
        $validTransition = true;
    }

    if ($current_status == "done" && $new_status == "in-progress") {
        $validTransition = true;
    }

    if (!$validTransition) {
        echo json_encode(["ok" => false, "message" => "Invalid task movement"]);
        exit();
    }

    if ($taskModel->updateStatus($task_id, $new_status)) {
        $statusText = ucfirst(str_replace("-", " ", $new_status));
        log_activity($task["project_id"], $_SESSION["user_id"], "Task '" . $task["title"] . "' moved to " . $statusText);

        echo json_encode([
            "ok" => true,
            "new_status" => $new_status
        ]);
    } else {
        echo json_encode(["ok" => false, "message" => "Status update failed"]);
    }
}
?>