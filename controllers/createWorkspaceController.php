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

$name = "";
$description = "";
$error = "";
$success = "";

function generateInviteCode() {
    return strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);

    if (empty($name)) {
        $error = "Workspace name is required.";
    } else {
        $database = new Database();
        $conn = $database->connection();

        $workspaceModel = new WorkspaceModel($conn);

        $invite_code = generateInviteCode();

        $workspace_id = $workspaceModel->createWorkspace($name, $description, $_SESSION["user_id"], $invite_code);

        if ($workspace_id) {
            $workspaceModel->addMember($workspace_id, $_SESSION["user_id"]);
            $_SESSION["workspace_id"] = $workspace_id;

            header("Location: workspaceHome.php");
            exit();
        } else {
            $error = "Workspace creation failed.";
        }
    }
}
?>