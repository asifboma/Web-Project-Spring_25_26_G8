<?php
include __DIR__ . "/../config/db.php";
include __DIR__ . "/../models/UserModel.php";
include __DIR__ . "/../models/WorkspaceModel.php";

    session_start();


$email = "";
$password = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    }
    elseif (strlen($password) > 8) {
        $error = "Password must be at least 8 characters long.";
    }
else {
        $database = new Database();
        $connection = $database->connection();

        $userModel = new UserModel($connection);
        $workspaceModel = new WorkspaceModel($connection);

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