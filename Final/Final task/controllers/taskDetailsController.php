<?php

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/TaskModel.php";
require_once __DIR__ . "/../models/ProjectModel.php";
require_once __DIR__ . "/../models/CommentModel.php";

session_start();

if(!isset($_SESSION["user_id"]))
{
    header("Location: ../auth/login.php");
}

if(!isset($_GET["task_id"]))
{
    header("Location: ../project/projectList.php");
}

$task_id = $_GET["task_id"];

$database = new Database();
$connection = $database->connection();

$taskModel = new TaskModel($connection);
$projectModel = new ProjectModel($connection);
$commentModel = new CommentModel($connection);

$taskResult = $taskModel->getTaskById($task_id);

if($taskResult->num_rows == 0)
{
    echo "Task not found.";
}
else
{
    $task = $taskResult->fetch_assoc();

    $projectResult = $projectModel->getProjectById($task["project_id"]);

    if($projectResult->num_rows == 0)
    {
        echo "Project not found.";
    }
    else
    {
        $project = $projectResult->fetch_assoc();

        if($project["workspace_id"] != $_SESSION["workspace_id"])
        {
            echo "You are not allowed to access this task.";
        }
        else
        {
            $comments = $commentModel->getCommentsByTask($task_id);
        }
    }}

