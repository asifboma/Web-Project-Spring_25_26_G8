<?php

class ActivityModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getActivities($project_id, $user_id = null) {
        if ($user_id == null || $user_id == "") {
            $sql = "SELECT activity_logs.*, users.name
                    FROM activity_logs
                    JOIN users ON activity_logs.user_id = users.id
                    WHERE activity_logs.project_id = ?
                    ORDER BY activity_logs.created_at DESC
                    LIMIT 50";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $project_id);
        } else {
            $sql = "SELECT activity_logs.*, users.name
                    FROM activity_logs
                    JOIN users ON activity_logs.user_id = users.id
                    WHERE activity_logs.project_id = ? AND activity_logs.user_id = ?
                    ORDER BY activity_logs.created_at DESC
                    LIMIT 50";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $project_id, $user_id);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
}
?>