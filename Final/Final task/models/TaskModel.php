<?php

class TaskModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function createTask($project_id, $title, $description, $assigned_to, $priority, $due_date)
    {
        $sql = "INSERT INTO tasks(project_id, title, description, assigned_to, priority, due_date, status)
                VALUES('$project_id', '$title', '$description', '$assigned_to', '$priority', '$due_date', 'todo')";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function getTasksByStatus($project_id, $status)
    {
        $sql = "SELECT tasks.*, users.name AS assigned_name
                FROM tasks
                LEFT JOIN users ON tasks.assigned_to = users.id
                WHERE tasks.project_id = '$project_id'
                AND tasks.status = '$status'
                ORDER BY tasks.due_date ASC";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function getTaskById($task_id)
    {
        $sql = "SELECT tasks.*, users.name AS assigned_name
            FROM tasks
            LEFT JOIN users
            ON tasks.assigned_to = users.id
            WHERE tasks.id = '$task_id'";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function updateTaskStatus($task_id, $status)
{
    $sql = "UPDATE tasks
            SET status = '$status'
            WHERE id = '$task_id'";

    $result = $this->conn->query($sql);

    return $result;
}
}

?>