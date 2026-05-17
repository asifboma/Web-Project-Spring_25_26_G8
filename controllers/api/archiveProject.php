<?php
require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../models/ProjectModel.php";

session_start();
header("Content-Type: application/json");

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["workspace_id"])) {
    echo json_encode(["ok" => false, "message" => "Unauthorized"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["ok" => false, "message" => "Invalid request"]);
    exit();
}

if (!isset($_POST["project_id"])) {
    echo json_encode(["ok" => false, "message" => "Missing project_id"]);
    exit();
}

$project_id = (int) $_POST["project_id"];

$database = new Database();
$conn = $database->connection();

$projectModel = new ProjectModel($conn);

$projectResult = $projectModel->getProjectById($conn, $project_id);

if (!$projectResult || $projectResult->num_rows == 0) {
    echo json_encode(["ok" => false, "message" => "Project not found"]);
    exit();
}

$project = $projectResult->fetch_assoc();

if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
    echo json_encode(["ok" => false, "message" => "Not allowed"]);
    exit();
}

if ($projectModel->archiveProject($conn, $project_id)) {
    echo json_encode(["ok" => true]);
} else {
    echo json_encode(["ok" => false, "message" => "Archive failed"]);
}
?>