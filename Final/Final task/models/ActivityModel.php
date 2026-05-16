<?php

class ActivityModel
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function getActivities($project_id, $user_id = "")
    {
        if($user_id == "")
        {
            $sql = "SELECT activity_logs.*, users.name
                    FROM activity_logs, users
                    WHERE activity_logs.user_id = users.id
                    AND activity_logs.project_id = '$project_id'
                    ORDER BY activity_logs.created_at DESC
                    LIMIT 50";
        }
        else
        {
            $sql = "SELECT activity_logs.*, users.name
                    FROM activity_logs, users
                    WHERE activity_logs.user_id = users.id
                    AND activity_logs.project_id = '$project_id'
                    AND activity_logs.user_id = '$user_id'
                    ORDER BY activity_logs.created_at DESC
                    LIMIT 50";
        }

        $result = $this->conn->query($sql);

        return $result;
    }
}

?>