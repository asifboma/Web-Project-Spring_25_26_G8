<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/ProjectModel.php";
require_once __DIR__ . "/../models/WorkspaceModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: projectList.php");
    exit();
}

$project_id = $_GET["id"];

$database = new Database();
$connection = $database->connection();

$projectModel = new ProjectModel($connection);
$workspaceModel = new WorkspaceModel($connection);

/* ✅ FIX 1: store result + FIX 2: correct variable name */
$projectResult = $projectModel->getProjectById($connection, $project_id);

if ($projectResult->num_rows == 0) {
    echo "Project not found.";
    exit();
}

$project = $projectResult->fetch_assoc();

if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
    echo "You are not allowed to access this project.";
    exit();
}

$summary = $projectModel->getTaskSummary($connection, $project_id);

if ($summary["todo_count"] == null) {
    $summary["todo_count"] = 0;
}

if ($summary["progress_count"] == null) {
    $summary["progress_count"] = 0;
}

if ($summary["done_count"] == null) {
    $summary["done_count"] = 0;
}

$members = $projectModel->getMemberTaskCounts($connection, $project_id);
?>