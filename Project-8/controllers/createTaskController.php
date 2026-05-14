

<?php
require_once "../config/db.php";
require_once "../models/TaskModel.php";
require_once "../models/ProjectModel.php";
require_once "../config/helpers.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../views/auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST["project_id"];
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $assigned_to = $_POST["assigned_to"];
    $priority = $_POST["priority"];
    $due_date = $_POST["due_date"];

    if (empty($title) || empty($assigned_to) || empty($priority) || empty($due_date)) {
        echo "Title, assigned member, priority and due date are required.";
        exit();
    }

    $database = new Database();
    $conn = $database->connection();

    $projectModel = new ProjectModel($conn);
    $taskModel = new TaskModel($conn);

    $projectResult = $projectModel->getProjectById($project_id);

    if ($projectResult->num_rows == 0) {
        echo "Project not found.";
        exit();
    }

    $project = $projectResult->fetch_assoc();

    if ($project["workspace_id"] != $_SESSION["workspace_id"]) {
        echo "You are not allowed to create task in this project.";
        exit();
    }

    if ($taskModel->createTask($project_id, $title, $description, $assigned_to, $priority, $due_date)) {
        log_activity($project_id, $_SESSION["user_id"], "Task '$title' created");

        header("Location: ../views/task/taskBoard.php?project_id=" . $project_id);
        exit();
    } else {
        echo "Task creation failed.";
    }
}
?>