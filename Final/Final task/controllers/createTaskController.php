<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/TaskModel.php";
require_once __DIR__ . "/../models/ProjectModel.php";
require_once __DIR__ . "/../models/ActivityModel.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/auth/login.php");
    exit();
}

$project_id = "";
$title = "";
$description = "";
$assigned_to = "";
$priority = "";
$due_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $assigned_to = $_POST["assigned_to"];
    $priority = $_POST["priority"];
    $due_date = $_POST["due_date"];

    if (empty($title) || empty($assigned_to) || empty($priority) || empty($due_date)) {
        echo "Title, assigned member, priority and due date are required.";
        exit();
    }

    $database = new Database();
    $connection = $database->connection();

    $projectModel = new ProjectModel($connection);
    $taskModel = new TaskModel($connection);

    $projectResult = $projectModel->getProjectById($connection, $project_id);

    if ($projectResult->num_rows == 0) {
        echo "Project not found.";
        exit();
    }

    $project = $projectResult->fetch_assoc();

    if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
        echo "You are not allowed to create task in this project.";
        exit();
    }

    if ($taskModel->createTask($project_id, $title, $description, $assigned_to, $priority, $due_date)) {

    $activityModel = new ActivityModel($connection);
    $activityModel->addActivity($project_id, $_SESSION["user_id"], "created a task: " . $title);

    header("Location: ../views/task/taskBoard.php?project_id=" . $project_id);
    exit();
}
}
?>