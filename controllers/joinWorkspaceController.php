<?php
include __DIR__ . "/../config/db.php";
include __DIR__ . "/../models/WorkspaceModel.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}
$invite_code = "";
$error = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $invite_code = strtoupper($_POST["invite_code"]);

    if (empty($invite_code)) {
        $error = "Invite code is required.";
    } else {
        $database = new Database();
        $connection = $database->connection();

        $workspaceModel = new WorkspaceModel($connection);
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
