<?php

class CommentModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function addComment($task_id, $user_id, $body) {
        $sql = "INSERT INTO comments (task_id, user_id, body) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $task_id, $user_id, $body);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }

        return false;
    }

    public function getCommentsByTask($task_id) {
        $sql = "SELECT comments.*, users.name
                FROM comments
                JOIN users ON comments.user_id = users.id
                WHERE comments.task_id = ?
                ORDER BY comments.created_at ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getCommentById($comment_id) {
        $sql = "SELECT * FROM comments WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $comment_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function deleteComment($comment_id, $user_id) {
        $sql = "DELETE FROM comments WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $comment_id, $user_id);

        return $stmt->execute();
    }
}
?>