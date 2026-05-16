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

if (!isset($_SESSION["workspace_id"]) || $_SESSION["workspace_id"] == null) {
    header("Location: ../workspace/workspaceHome.php");
    exit();
}

$database = new Database();
$connection = $database->connection();

$workspaceModel = new WorkspaceModel($connection);

$workspaceResult = $workspaceModel->getWorkspaceById($_SESSION["workspace_id"]);

$workspace = $workspaceResult->fetch_assoc();

if (!$workspaceModel->isMember($_SESSION["workspace_id"], $_SESSION["user_id"])) {
    echo "You are not allowed to access this workspace.";
    exit();
}

$projectModel = new ProjectModel($connection);

$projects = $projectModel->getProjects($connection, $_SESSION["workspace_id"], 0);
?>