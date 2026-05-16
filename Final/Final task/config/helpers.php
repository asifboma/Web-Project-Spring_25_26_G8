<?php

require_once __DIR__ . "/db.php";

function log_activity($project_id, $user_id, $action_text)
{
    $database = new Database();
    $connection = $database->connection();

    $sql = "INSERT INTO activity_logs(project_id, user_id, action_text)
            VALUES('$project_id', '$user_id', '$action_text')";

    $result = $connection->query($sql);

    return $result;
}

function getInitials($name)
{
    $words = explode(" ", trim($name));
    $initials = "";

    foreach($words as $word)
    {
        if($word != "")
        {
            $initials = $initials . strtoupper($word[0]);
        }
    }

    return substr($initials, 0, 2);
}

function timeAgo($datetime)
{
    $time = strtotime($datetime);
    $difference = time() - $time;

    if($difference < 60)
    {
        return "Just now";
    }
    else if($difference < 3600)
    {
        return floor($difference / 60) . " minutes ago";
    }
    else if($difference < 86400)
    {
        return floor($difference / 3600) . " hours ago";
    }
    else
    {
        return floor($difference / 86400) . " days ago";
    }
}

?>