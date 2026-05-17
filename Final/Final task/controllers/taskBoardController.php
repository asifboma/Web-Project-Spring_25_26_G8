<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/ProjectModel.php";
require_once __DIR__ . "/../models/TaskModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET["project_id"])) {
    header("Location: ../project/projectList.php");
    exit();
}


$project_id = $_GET["project_id"];

$database = new Database();
$connection = $database->connection();

$taskModel = new TaskModel($connection);
$projectModel = new ProjectModel();

$projectResult = $projectModel->getProjectById($connection, $project_id);


if(isset($_POST["move_task"]))
{
    $task_id = $_POST["task_id"];
    $status = $_POST["status"];

    
    $taskModel->updateTaskStatus($task_id, $status);

    header("Location: taskBoard.php?project_id=".$project_id);
}

if ($projectResult->num_rows == 0) {
    echo "Project not found.";
    exit();
}

$project = $projectResult->fetch_assoc();

if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
    echo "You are not allowed to access this project.";
    exit();
}

$todoTasks = $taskModel->getTasksByStatus($project_id, "todo");
$progressTasks = $taskModel->getTasksByStatus($project_id, "in-progress");
$doneTasks = $taskModel->getTasksByStatus($project_id, "done");

$members = $projectModel->getProjectMembers($connection, $project_id);
?>