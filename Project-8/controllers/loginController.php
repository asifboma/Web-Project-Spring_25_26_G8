<?php
require_once "../config/db.php";
require_once "../models/UserModel.php";
require_once "../models/WorkspaceModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = "";
$password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        $database = new Database();
        $conn = $database->connection();

        $userModel = new UserModel($conn);
        $workspaceModel = new WorkspaceModel($conn);

        $result = $userModel->login($email);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password_hash"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["name"] = $user["name"];

                $workspaceResult = $workspaceModel->getFirstWorkspace($user["id"]);

                if ($workspaceResult->num_rows > 0) {
                    $workspace = $workspaceResult->fetch_assoc();
                    $_SESSION["workspace_id"] = $workspace["id"];

                    header("Location: ../workspace/workspaceHome.php");
                    exit();
                } else {
                    $_SESSION["workspace_id"] = null;

                    header("Location: ../workspace/workspaceHome.php");
                    exit();
                }
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with this email.";
        }
    }
}
?>