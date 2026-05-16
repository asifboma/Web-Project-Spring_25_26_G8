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

if (!isset($_GET["id"])) {
    header("Location: projectList.php");
    exit();
}

$project_id = $_GET["id"];

$database = new Database();
$connection = $database->connection();

$projectModel = new ProjectModel($connection);
$workspaceModel = new WorkspaceModel($connection);

$projectResult = $projectModel->getProjectById($connection, $project_id);

if ($projectResult->num_rows == 0) {
    echo "Project not found.";
    exit();
}

$project = $projectResult->fetch_assoc();

if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
    echo "You are not allowed to edit this project.";
    exit();
}

$name = $project["name"];
$description = $project["description"];
$deadline = $project["deadline"];
$color_label = $project["color_label"];
$error = "";

$workspaceMembers = $workspaceModel->getMembers($_SESSION["workspace_id"]);
$selectedMembers = $projectModel->getProjectMemberIds($connection, $project_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $deadline = $_POST["deadline"];
    $color_label = $_POST["color_label"];

    if (isset($_POST["members"])) {
        $members = $_POST["members"];
    } else {
        $members = [];
    }

    if (empty($name) || empty($deadline) || empty($color_label)) {
        $error = "Name, deadline and color are required.";
    } elseif (count($members) == 0) {
        $error = "Please select at least one project member.";
    } else {

        $updated = $projectModel->updateProject(
            $connection,
            $project_id,
            $name,
            $description,
            $deadline,
            $color_label
        );

        if ($updated) {
            $projectModel->replaceProjectMembers($connection, $project_id, $members);

            header("Location: projectDetails.php?id=" . $project_id);
            exit();
        } else {
            $error = "Project update failed.";
        }
    }
}
?>