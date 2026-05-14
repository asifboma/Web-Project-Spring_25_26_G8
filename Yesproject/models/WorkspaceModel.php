<?php

class WorkspaceModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function createWorkspace($name, $description, $owner_id, $invite_code) {
        $sql = "INSERT INTO workspaces (name, description, owner_id, invite_code) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $name, $description, $owner_id, $invite_code);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }

        return false;
    }

    public function addMember($workspace_id, $user_id) {
        $sql = "INSERT INTO workspace_members (workspace_id, user_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $workspace_id, $user_id);
        return $stmt->execute();
    }

    public function getWorkspaceByInviteCode($invite_code) {
        $sql = "SELECT * FROM workspaces WHERE invite_code = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $invite_code);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getUserWorkspaces($user_id) {
        $sql = "SELECT w.* 
                FROM workspaces w
                JOIN workspace_members wm ON w.id = wm.workspace_id
                WHERE wm.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function getFirstWorkspace($user_id) {
        $sql = "SELECT w.* 
                FROM workspaces w
                JOIN workspace_members wm ON w.id = wm.workspace_id
                WHERE wm.user_id = ?
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function isMember($workspace_id, $user_id) {
        $sql = "SELECT id FROM workspace_members WHERE workspace_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $workspace_id, $user_id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function isOwner($workspace_id, $user_id) {
        $sql = "SELECT id FROM workspaces WHERE id = ? AND owner_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $workspace_id, $user_id);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }

    public function getMembers($workspace_id) {
        $sql = "SELECT wm.id AS member_id, users.id AS user_id, users.name, users.email, wm.joined_at
                FROM workspace_members wm
                JOIN users ON wm.user_id = users.id
                WHERE wm.workspace_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $workspace_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function removeMember($member_id, $workspace_id, $owner_id) {
        $sql = "DELETE wm FROM workspace_members wm
                JOIN workspaces w ON wm.workspace_id = w.id
                WHERE wm.id = ? 
                AND wm.workspace_id = ?
                AND w.owner_id = ?
                AND wm.user_id != ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $member_id, $workspace_id, $owner_id, $owner_id);
        return $stmt->execute();
    }

    public function getWorkspaceById($workspace_id) {
    $sql = "SELECT * FROM workspaces WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $workspace_id);
    $stmt->execute();

    return $stmt->get_result();
}
}
?>