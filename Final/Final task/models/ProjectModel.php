<?php

class ProjectModel {

    function createProject($connection, $workspace_id, $name, $description, $deadline, $color_label) {

        $sql = "INSERT INTO projects(workspace_id, name, description, deadline, color_label)
                VALUES('$workspace_id', '$name', '$description', '$deadline', '$color_label')";

        $result = $connection->query($sql);

        if($result) {
            return $connection->insert_id;
        }

        return false;
    }

    function addProjectMember($connection, $project_id, $user_id) {

        $sql = "INSERT INTO project_members(project_id, user_id)
                VALUES('$project_id', '$user_id')";

        $result = $connection->query($sql);

        return $result;
    }

    function replaceProjectMembers($connection, $project_id, $members) {

        $deleteSql = "DELETE FROM project_members
                      WHERE project_id = '$project_id'";

        $connection->query($deleteSql);

        foreach($members as $user_id) {

            $this->addProjectMember($connection, $project_id, $user_id);
        }

        return true;
    }

    function getProjects($connection, $workspace_id, $archived = 0) {

        $sql = "SELECT p.*,

                (SELECT COUNT(*)
                 FROM tasks t
                 WHERE t.project_id = p.id) AS total_tasks,

                (SELECT COUNT(*)
                 FROM tasks t
                 WHERE t.project_id = p.id
                 AND t.status = 'done') AS done_tasks

                FROM projects p

                WHERE p.workspace_id = '$workspace_id'
                AND p.is_archived = '$archived'

                ORDER BY p.created_at DESC";

        $result = $connection->query($sql);

        return $result;
    }

    function getProjectById($connection, $project_id) {

        $sql = "SELECT *
                FROM projects
                WHERE id = '$project_id'";

        $result = $connection->query($sql);

        return $result;
    }

    function updateProject($connection, $project_id, $name, $description, $deadline, $color_label) {

        $sql = "UPDATE projects
                SET name = '$name',
                    description = '$description',
                    deadline = '$deadline',
                    color_label = '$color_label'
                WHERE id = '$project_id'";

        $result = $connection->query($sql);

        return $result;
    }

    function archiveProject($connection, $project_id) {

        $sql = "UPDATE projects
                SET is_archived = 1
                WHERE id = '$project_id'";

        $result = $connection->query($sql);

        return $result;
    }

    function getWorkspaceMembers($connection, $workspace_id)
{
    $sql = "SELECT users.id, users.name, users.email
            FROM workspace_members wm
            JOIN users
            ON wm.user_id = users.id
            WHERE wm.workspace_id = '$workspace_id'";

    $result = $connection->query($sql);

    return $result;
}

    function getProjectMemberIds($connection, $project_id) {

        $ids = array();

        $result = $this->getProjectMembers($connection, $project_id);

        while($row = $result->fetch_assoc()) {

            $ids[] = $row['id'];
        }

        return $ids;
    }

    function getTaskSummary($connection, $project_id) {

        $sql = "SELECT

                SUM(status = 'todo') AS todo_count,

                SUM(status = 'in-progress') AS progress_count,

                SUM(status = 'done') AS done_count

                FROM tasks

                WHERE project_id = '$project_id'";

        $result = $connection->query($sql);

        return $result->fetch_assoc();
    }

    function getMemberTaskCounts($connection, $project_id) {

        $sql = "SELECT users.name,
                       COUNT(tasks.id) AS task_count

                FROM project_members pm

                JOIN users
                ON pm.user_id = users.id

                LEFT JOIN tasks
                ON tasks.assigned_to = users.id
                AND tasks.project_id = pm.project_id

                WHERE pm.project_id = '$project_id'

                GROUP BY users.id, users.name";

        $result = $connection->query($sql);

        return $result;
    }

    function getProjectMembers($connection, $project_id)
{
    $sql = "SELECT users.id, users.name, users.email
            FROM projects p, workspace_members wm, users
            WHERE p.workspace_id = wm.workspace_id
            AND wm.user_id = users.id
            AND p.id = '$project_id'";

    $result = $connection->query($sql);

    return $result;
}

}

?>