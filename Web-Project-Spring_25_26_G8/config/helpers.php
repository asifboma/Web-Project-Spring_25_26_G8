<?php
function redirect($path) {
    header("Location: " . $path);
    exit();
}

function log_activity($conn, $project_id, $user_id, $action_text) {
    $stmt = $conn->prepare("INSERT INTO activity_logs (project_id, user_id, action_text, created_at) VALUES (?, ?, ?, NOW())");
    if ($stmt) {
        $stmt->bind_param("iis", $project_id, $user_id, $action_text);
        return $stmt->execute();
    }
    return false;
}
?>
