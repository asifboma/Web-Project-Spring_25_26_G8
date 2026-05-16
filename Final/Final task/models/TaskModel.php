<?php

class TaskModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
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
}

?>