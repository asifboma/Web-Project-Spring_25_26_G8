<?php

class TaskModel {

    function createTask($connection, $project_id, $title, $description, $assigned_to, $priority, $due_date) {

        $sql = "INSERT INTO tasks(project_id, title, description, assigned_to, priority, due_date, status)
                VALUES('$project_id', '$title', '$description', '$assigned_to', '$priority', '$due_date', 'todo')";
        $result = $connection->query($sql);
        return $result;
    }


    function getTasksByStatus($connection, $project_id, $status) {

        $sql = "SELECT tasks.*, users.name AS assigned_name FROM tasks LEFT JOIN users ON tasks.assigned_to = users.id 
        WHERE tasks.project_id = '$project_id' AND tasks.status = '$status' ORDER BY tasks.created_at DESC";
        $result = $connection->query($sql);
        return $result;
    }


    function getTaskById($connection, $task_id) {

        $sql = "SELECT tasks.*, users.name AS assigned_name FROM tasks LEFT JOIN users ON tasks.assigned_to = users.id WHERE tasks.id = '$task_id'";
        $result = $connection->query($sql);
        return $result;
    }


    function updateStatus($connection, $task_id, $status) {

        $sql = "UPDATE tasks SET status = '$status' WHERE id = '$task_id'";
        $result = $connection->query($sql);
        return $result;
    }


    function deleteTask($connection, $task_id) {

        $sql = "DELETE FROM tasks WHERE id = '$task_id'";
        $result = $connection->query($sql);
        return $result;
    }
}
?>