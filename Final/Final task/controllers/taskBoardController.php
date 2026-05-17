<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/ProjectModel.php";
require_once __DIR__ . "/../models/TaskModel.php";
require_once __DIR__ . "/../config/helpers.php";
require_once __DIR__ . "/../models/ActivityModel.php";

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

    $taskResult = $taskModel->getTaskById($task_id);

    if($taskResult && $taskResult->num_rows > 0)
    {
        $task = $taskResult->fetch_assoc();

        $oldStatus = $task["status"];

        if($taskModel->updateTaskStatus($task_id, $status))
        {
            $activityModel = new ActivityModel($connection);

            $oldStatusText = ucfirst(str_replace("-", " ", $oldStatus));
            $newStatusText = ucfirst(str_replace("-", " ", $status));

            $activityModel->addActivity(
                $task["project_id"],
                $_SESSION["user_id"],
                "moved task '" . $task["title"] . "' from " . $oldStatusText . " to " . $newStatusText
            );
        }
    }

    header("Location: taskBoard.php?project_id=".$project_id);
    exit();
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