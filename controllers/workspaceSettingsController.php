<?php
include __DIR__ . "/../config/db.php";
include __DIR__ . "/../models/WorkspaceModel.php";

session_start();


if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_SESSION["workspace_id"]) || $_SESSION["workspace_id"] == null) {
    header("Location: workspaceHome.php");
    exit();
}

$database = new Database();
$connection = $database->connection();

$workspaceModel = new WorkspaceModel($connection);

$isOwner = $workspaceModel->isOwner($_SESSION["workspace_id"], $_SESSION["user_id"]);

if (!$isOwner) {
    echo "Only workspace owner can access this page.";
    exit();
}

$members = $workspaceModel->getMembers($_SESSION["workspace_id"]);
?>
