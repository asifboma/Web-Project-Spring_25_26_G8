<?php
require_once "../config/db.php";
require_once "../models/WorkspaceModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_SESSION["workspace_id"]) || $_SESSION["workspace_id"] == null) {
    header("Location: workspaceHome.php");
    exit();
}

$database = new Database();
$conn = $database->connection();

$workspaceModel = new WorkspaceModel($conn);

$isOwner = $workspaceModel->isOwner($_SESSION["workspace_id"], $_SESSION["user_id"]);

if (!$isOwner) {
    echo "Only workspace owner can access this page.";
    exit();
}

$members = $workspaceModel->getMembers($_SESSION["workspace_id"]);
?>