<?php

class CommentModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function addComment($task_id, $user_id, $body)
    {
        $sql = "INSERT INTO comments(task_id, user_id, body)
                VALUES('$task_id', '$user_id', '$body')";

        $result = $this->conn->query($sql);

        if($result)
        {
            return $this->conn->insert_id;
        }
        else
        {
            return false;
        }
    }

    public function getCommentsByTask($task_id)
    {
        $sql = "SELECT comments.*, users.name
                FROM comments, users
                WHERE comments.user_id = users.id
                AND comments.task_id = '$task_id'
                ORDER BY comments.created_at ASC";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function getCommentById($comment_id)
    {
        $sql = "SELECT * FROM comments
                WHERE id = '$comment_id'";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function deleteComment($comment_id, $user_id)
    {
        $sql = "DELETE FROM comments
                WHERE id = '$comment_id'
                AND user_id = '$user_id'";

        $result = $this->conn->query($sql);

        return $result;
    }
}

?>