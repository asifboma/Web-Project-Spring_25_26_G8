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

$database = new Database();
$conn = $database->connection();

$workspaceModel = new WorkspaceModel($conn);
$projectModel = new ProjectModel($conn);

if (!$workspaceModel->isMember($_SESSION["workspace_id"], $_SESSION["user_id"])) {
    echo "You are not allowed to access this workspace.";
    exit();
}

$name = "";
$description = "";
$deadline = "";
$color_label = "#3498db";
$error = "";

$members = $workspaceModel->getMembers($_SESSION["workspace_id"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $deadline = $_POST["deadline"];
    $color_label = $_POST["color_label"];

    if (isset($_POST["members"])) {
        $selected_members = $_POST["members"];
    } else {
        $selected_members = [];
    }

    if (empty($name) || empty($deadline) || empty($color_label)) {
        $error = "Name, deadline and color are required.";
    } elseif (count($selected_members) == 0) {
        $error = "Please select at least one project member.";
    } else {

        $project_id = $projectModel->createProject(
            $conn,
            $_SESSION["workspace_id"],
            $name,
            $description,
            $deadline,
            $color_label
        );

        if ($project_id) {

            foreach ($selected_members as $user_id) {

                // ✅ FIX: pass connection also
                $projectModel->addProjectMember($conn, $project_id, $user_id);
            }

            header("Location: projectList.php");
            exit();

        } else {
            $error = "Project creation failed.";
        }
    }
}
?>