<?php

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../../models/CommentModel.php";
require_once __DIR__ . "/../../models/TaskModel.php";
require_once __DIR__ . "/../../config/helpers.php";

session_start();

header("Content-Type: application/json");

if(!isset($_SESSION["user_id"]))
{
    echo json_encode(array("ok" => false, "message" => "Unauthorized"));
}
else
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $task_id = $_POST["task_id"];
        $body = trim($_POST["body"]);

        if($body == "")
        {
            echo json_encode(array("ok" => false, "message" => "Comment cannot be empty"));
        }
        else
        {
            $database = new Database();
            $connection = $database->connection();

            $commentModel = new CommentModel($connection);
            $taskModel = new TaskModel($connection);

            $taskResult = $taskModel->getTaskById($task_id);

            if($taskResult->num_rows == 0)
            {
                echo json_encode(array("ok" => false, "message" => "Task not found"));
            }
            else
            {
                $task = $taskResult->fetch_assoc();

                $comment_id = $commentModel->addComment($task_id, $_SESSION["user_id"], $body);

                if($comment_id)
                {
                    log_activity($task["project_id"], $_SESSION["user_id"], "Commented on task '".$task["title"]."'");

                    echo json_encode(array(
                        "ok" => true,
                        "comment_id" => $comment_id,
                        "author" => $_SESSION["name"],
                        "body" => $body,
                        "created_at" => date("Y-m-d H:i:s"),
                        "user_id" => $_SESSION["user_id"]
                    ));
                }
                else
                {
                    echo json_encode(array("ok" => false, "message" => "Comment post failed"));
                }
            }
        }
    }
}

?>