<?php
require_once "../../config/db.php";
require_once "../../models/CommentModel.php";
require_once "../../models/TaskModel.php";
require_once "../../config/helpers.php";

session_start();

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["ok" => false, "message" => "Unauthorized"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_id = $_POST["comment_id"];

    $database = new Database();
    $conn = $database->connection();

    $commentModel = new CommentModel($conn);
    $taskModel = new TaskModel($conn);

    $commentResult = $commentModel->getCommentById($comment_id);

    if ($commentResult->num_rows == 0) {
        echo json_encode(["ok" => false, "message" => "Comment not found"]);
        exit();
    }

    $comment = $commentResult->fetch_assoc();

    if ($comment["user_id"] != $_SESSION["user_id"]) {
        echo json_encode(["ok" => false, "message" => "You can delete only your own comment"]);
        exit();
    }

    $taskResult = $taskModel->getTaskById($comment["task_id"]);

    if ($taskResult->num_rows == 0) {
        echo json_encode(["ok" => false, "message" => "Task not found"]);
        exit();
    }

    $task = $taskResult->fetch_assoc();

    if ($commentModel->deleteComment($comment_id, $_SESSION["user_id"])) {
        log_activity($task["project_id"], $_SESSION["user_id"], "Deleted comment from task '" . $task["title"] . "'");

        echo json_encode(["ok" => true]);
    } else {
        echo json_encode(["ok" => false, "message" => "Comment delete failed"]);
    }
}
?>