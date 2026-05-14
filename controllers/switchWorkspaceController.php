<?php
require_once "../config/db.php";
require_once "../models/WorkspaceModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/auth/login.php");
    exit();
}

if (isset($_GET["id"])) {
    $workspace_id = $_GET["id"];

    $database = new Database();
    $conn = $database->connection();

    $workspaceModel = new WorkspaceModel($conn);

    if ($workspaceModel->isMember($workspace_id, $_SESSION["user_id"])) {
        $_SESSION["workspace_id"] = $workspace_id;
    }
}

header("Location: ../views/project/projectList.php");
exit();
?>