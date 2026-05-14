<?php

class ProjectModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function createProject($workspace_id, $name, $description, $deadline, $color_label) {
        $sql = "INSERT INTO projects (workspace_id, name, description, deadline, color_label) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issss", $workspace_id, $name, $description, $deadline, $color_label);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }

        return false;
    }

    public function addProjectMember($project_id, $user_id) {
        $sql = "INSERT INTO project_members (project_id, user_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $project_id, $user_id);
        return $stmt->execute();
    }

    public function replaceProjectMembers($project_id, $members) {
        $deleteSql = "DELETE FROM project_members WHERE project_id = ?";
        $deleteStmt = $this->conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $project_id);
        $deleteStmt->execute();

        foreach ($members as $user_id) {
            $this->addProjectMember($project_id, $user_id);
        }

        return true;
    }

    public function getProjects($workspace_id, $archived = 0) {
        $sql = "SELECT p.*,
                (SELECT COUNT(*) FROM tasks t WHERE t.project_id = p.id) AS total_tasks,
                (SELECT COUNT(*) FROM tasks t WHERE t.project_id = p.id AND t.status = 'done') AS done_tasks
                FROM projects p
                WHERE p.workspace_id = ? AND p.is_archived = ?
                ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $workspace_id, $archived);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getProjectById($project_id) {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $project_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function updateProject($project_id, $name, $description, $deadline, $color_label) {
        $sql = "UPDATE projects 
                SET name = ?, description = ?, deadline = ?, color_label = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $description, $deadline, $color_label, $project_id);

        return $stmt->execute();
    }

    public function archiveProject($project_id) {
        $sql = "UPDATE projects SET is_archived = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $project_id);

        return $stmt->execute();
    }

    public function getProjectMembers($project_id) {
        $sql = "SELECT users.id, users.name, users.email
                FROM project_members pm
                JOIN users ON pm.user_id = users.id
                WHERE pm.project_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $project_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getProjectMemberIds($project_id) {
        $ids = [];
        $result = $this->getProjectMembers($project_id);

        while ($row = $result->fetch_assoc()) {
            $ids[] = $row["id"];
        }

        return $ids;
    }

    public function getTaskSummary($project_id) {
        $sql = "SELECT 
                SUM(status = 'todo') AS todo_count,
                SUM(status = 'in-progress') AS progress_count,
                SUM(status = 'done') AS done_count
                FROM tasks
                WHERE project_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $project_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function getMemberTaskCounts($project_id) {
        $sql = "SELECT users.name, COUNT(tasks.id) AS task_count
                FROM project_members pm
                JOIN users ON pm.user_id = users.id
                LEFT JOIN tasks ON tasks.assigned_to = users.id AND tasks.project_id = pm.project_id
                WHERE pm.project_id = ?
                GROUP BY users.id, users.name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $project_id);
        $stmt->execute();

        return $stmt->get_result();
    }
}
?>