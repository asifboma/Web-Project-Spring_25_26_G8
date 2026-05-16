<?php
include __DIR__ . "/../config/db.php";
include __DIR__ . "/../models/WorkspaceModel.php";
session_start();


if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/auth/login.php");
    exit();
}

if (isset($_GET["id"])) {
    $workspace_id = $_GET["id"];

    $database = new Database();
    $connection = $database->connection();

    $workspaceModel = new WorkspaceModel($connection);

    if ($workspaceModel->isMember($workspace_id, $_SESSION["user_id"])) {
        $_SESSION["workspace_id"] = $workspace_id;
    }
}

header("Location: ../views/project/projectList.php");
exit();
?>