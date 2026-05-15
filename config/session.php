<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkLogin() {
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../views/auth/login.php");
        exit();
    }
}

function checkWorkspace() {
    if (!isset($_SESSION["workspace_id"]) || $_SESSION["workspace_id"] == null) {
        header("Location: ../views/workspace/workspaceHome.php");
        exit();
    }
}
?>
