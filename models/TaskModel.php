<?php

class TaskModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function createTask($project_id, $title, $description, $assigned_to, $priority, $due_date) {
        $sql = "INSERT INTO tasks (project_id, title, description, assigned_to, priority, due_date, status)
                VALUES (?, ?, ?, ?, ?, ?, 'todo')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ississ", $project_id, $title, $description, $assigned_to, $priority, $due_date);

        return $stmt->execute();
    }

    public function getTasksByStatus($project_id, $status) {
        $sql = "SELECT tasks.*, users.name AS assigned_name
                FROM tasks
                LEFT JOIN users ON tasks.assigned_to = users.id
                WHERE tasks.project_id = ? AND tasks.status = ?
                ORDER BY tasks.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $project_id, $status);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getTaskById($task_id) {
        $sql = "SELECT tasks.*, users.name AS assigned_name
                FROM tasks
                LEFT JOIN users ON tasks.assigned_to = users.id
                WHERE tasks.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function updateStatus($task_id, $status) {
        $sql = "UPDATE tasks SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $task_id);

        return $stmt->execute();
    }
}
?>