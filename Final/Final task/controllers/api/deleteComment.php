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
        $comment_id = $_POST["comment_id"];

        $database = new Database();
        $connection = $database->connection();

        $commentModel = new CommentModel($connection);
        $taskModel = new TaskModel($connection);

        $commentResult = $commentModel->getCommentById($comment_id);

        if($commentResult->num_rows == 0)
        {
            echo json_encode(array("ok" => false, "message" => "Comment not found"));
        }
        else
        {
            $comment = $commentResult->fetch_assoc();

            if($comment["user_id"] != $_SESSION["user_id"])
            {
                echo json_encode(array("ok" => false, "message" => "You can delete only your own comment"));
            }
            else
            {
                $taskResult = $taskModel->getTaskById($comment["task_id"]);

                if($taskResult->num_rows == 0)
                {
                    echo json_encode(array("ok" => false, "message" => "Task not found"));
                }
                else
                {
                    $task = $taskResult->fetch_assoc();

                    $result = $commentModel->deleteComment($comment_id, $_SESSION["user_id"]);

                    if($result)
                    {
                        log_activity($task["project_id"], $_SESSION["user_id"], "Deleted comment from task '".$task["title"]."'");

                        echo json_encode(array("ok" => true));
                    }
                    else
                    {
                        echo json_encode(array("ok" => false, "message" => "Comment delete failed"));
                    }
                }
            }
        }
    }
}

?>