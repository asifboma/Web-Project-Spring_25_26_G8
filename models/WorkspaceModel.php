<?php

class WorkspaceModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createWorkspace($name, $description, $owner_id, $invite_code) {
        $sql = "INSERT INTO workspaces(name,description,owner_id,invite_code)VALUES('$name','$description','$owner_id','$invite_code')";
        $result = $this->connection->query($sql);
        return $this->connection->query($sql);
    }

    public function addMember($workspace_id, $user_id) {
        $sql = "INSERT INTO workspace_members (workspace_id, user_id) VALUES ($workspace_id, $user_id)";
        $result = $this->connection->query($sql);
        return $this->connection->query($sql);
    }

    public function getWorkspaceByInviteCode($invite_code) {
        $sql = "SELECT * FROM workspaces WHERE invite_code = '$invite_code'";
        $result = $this->connection->query($sql);
        return $this->connection->query($sql);
    }

    public function getUserWorkspaces($user_id) {
        $sql = "SELECT w.* FROM workspaces w
                JOIN workspace_members wm ON w.id = wm.workspace_id
                WHERE wm.user_id = $user_id";
                $result = $this->connection->query($sql);
        return $this->connection->query($sql);
 
    }

    public function getFirstWorkspace($user_id) {
        $sql = "SELECT w.* FROM workspaces w
                JOIN workspace_members wm ON w.id = wm.workspace_id
                WHERE wm.user_id = $user_id LIMIT 1";
                $result = $this->connection->query($sql);
                return $this->connection->query($sql);
       }

    public function isMember($workspace_id, $user_id) {
        $sql = "SELECT id FROM workspace_members WHERE workspace_id = $workspace_id AND user_id =$user_id";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;

    }

    public function isOwner($workspace_id, $user_id) {
        $sql = "SELECT id FROM workspaces WHERE id = $workspace_id  AND owner_id =$user_id";
        $result = $this->connection->query($sql);
        return $result->num_rows > 0;
 }

    public function getMembers($workspace_id) {
        $sql = "SELECT wm.id AS member_id, users.id AS user_id, users.name, users.email, wm.joined_at
                FROM workspace_members wm
                JOIN users ON wm.user_id = users.id
                WHERE wm.workspace_id = $workspace_id";
                $result = $this->connection->query($sql);
                return $this->connection->query($sql);
      }

    public function removeMember($member_id, $workspace_id, $owner_id) {
        $sql = "DELETE wm FROM workspace_members wm
                JOIN workspaces w ON wm.workspace_id = w.id
                WHERE wm.id = $member_id
                AND wm.workspace_id = $workspace_id 
                AND w.owner_id = $owner_id
                AND wm.user_id != $owner_id";
                $result = $this->connection->query($sql);
              return $this->connection->query($sql);
                }
}
?>
