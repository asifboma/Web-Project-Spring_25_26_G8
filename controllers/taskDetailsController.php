<?php
require_once "../../config/db.php";
require_once "../../models/TaskModel.php";
require_once "../../models/ProjectModel.php";
require_once "../../models/CommentModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET["task_id"])) {
    header("Location: ../project/projectList.php");
    exit();
}

$task_id = $_GET["task_id"];

$database = new Database();
$conn = $database->connection();

$taskModel = new TaskModel($conn);
$projectModel = new ProjectModel($conn);
$commentModel = new CommentModel($conn);

$taskResult = $taskModel->getTaskById($task_id);

if ($taskResult->num_rows == 0) {
    echo "Task not found.";
    exit();
}

$task = $taskResult->fetch_assoc();

$projectResult = $projectModel->getProjectById($task["project_id"]);

if ($projectResult->num_rows == 0) {
    echo "Project not found.";
    exit();
}

$project = $projectResult->fetch_assoc();

if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
    echo "You are not allowed to access this task.";
    exit();
}

$comments = $commentModel->getCommentsByTask($task_id);
?>