<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/ProjectModel.php";
require_once __DIR__ . "/../models/ActivityModel.php";
require_once __DIR__ . "/../config/helpers.php";

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
$conn = $database->connection();

$projectModel = new ProjectModel($conn);
$activityModel = new ActivityModel($conn);

$projectResult = $projectModel->getProjectById($project_id);

if ($projectResult->num_rows == 0) {
    echo "Project not found.";
    exit();
}

$project = $projectResult->fetch_assoc();

if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
    echo "You are not allowed to access this activity feed.";
    exit();
}

$members = $projectModel->getProjectMembers($project_id);
$activities = $activityModel->getActivities($project_id);
?>