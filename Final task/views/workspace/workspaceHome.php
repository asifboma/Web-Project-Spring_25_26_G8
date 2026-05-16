<?php
session_start();

include __DIR__ . "/../../config/db.php";
include __DIR__ . "/../../models/WorkspaceModel.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

$database = new Database();
$connection = $database->connection();

$workspaceModel = new WorkspaceModel($connection);

$workspaces = $workspaceModel->getUserWorkspaces($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Workspace Home</title>
</head>
<body>

    <h1>Workspace Home</h1>

    <p>Welcome, <?php echo $_SESSION["name"]; ?></p>

    <p>
        <a href="../../controllers/logoutController.php">Logout</a>
    </p>

    <?php if ($workspaces->num_rows == 0) { ?>

        <h2>You have no workspace yet.</h2>

        <p>
            <a href="createWorkspace.php">Create a new workspace</a>
        </p>

        <p>
            <a href="joinWorkspace.php">Join an existing workspace</a>
        </p>

    <?php } else { ?>

        <h2>Your Workspaces</h2>

        <form method="get" action="../../controllers/switchWorkspaceController.php">
            <label>Select Workspace:</label>

            <select name="id">
        <?php while ($workspace = $workspaces->fetch_assoc()) { ?>
            <option value="<?php echo $workspace['id']; ?>">
                <?php echo $workspace['name']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit">Go</button>
        </form>

        <br>

        <p>
            <a href="createWorkspace.php">Create Another Workspace</a>
        </p>

        <p>
            <a href="joinWorkspace.php">Join Workspace</a>
        </p>

        <p>
            <a href="workspaceSettings.php">Workspace Settings</a>
        </p>

    <?php } ?>

</body>
</html>