<?php
require_once "../../config/db.php";
require_once "../../models/WorkspaceModel.php";

session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["workspace_id"])) {
    echo json_encode(["ok" => false, "message" => "Unauthorized"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST["member_id"];

    $database = new Database();
    $conn = $database->connection();

    $workspaceModel = new WorkspaceModel($conn);

    if (!$workspaceModel->isOwner($_SESSION["workspace_id"], $_SESSION["user_id"])) {
        echo json_encode(["ok" => false, "message" => "Only owner can remove members"]);
        exit();
    }

    $result = $workspaceModel->removeMember($member_id, $_SESSION["workspace_id"], $_SESSION["user_id"]);

    if ($result) {
        echo json_encode(["ok" => true]);
    } else {
        echo json_encode(["ok" => false, "message" => "Remove failed"]);
    }
}
?>