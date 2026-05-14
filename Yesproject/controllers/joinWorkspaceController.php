<?php
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../models/WorkspaceModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

$invite_code = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invite_code = strtoupper(trim($_POST["invite_code"]));

    if (empty($invite_code)) {
        $error = "Invite code is required.";
    } else {
        $database = new Database();
        $conn = $database->connection();

        $workspaceModel = new WorkspaceModel($conn);

        $workspaceResult = $workspaceModel->getWorkspaceByInviteCode($invite_code);

        if ($workspaceResult->num_rows == 1) {
            $workspace = $workspaceResult->fetch_assoc();

            if ($workspaceModel->isMember($workspace["id"], $_SESSION["user_id"])) {
                $error = "You are already a member of this workspace.";
            } else {
                $workspaceModel->addMember($workspace["id"], $_SESSION["user_id"]);
                $_SESSION["workspace_id"] = $workspace["id"];

                header("Location: workspaceHome.php");
                exit();
            }
        } else {
            $error = "Invalid invite code.";
        }
    }
}
?>