<?php
include __DIR__ . "/../../controllers/createWorkspaceController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Workspace</title>
</head>
<body>

    <h1>Create Workspace</h1>

    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="name">Workspace Name:</label></td>
                <td>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
                </td>
            </tr>

            <tr>
                <td><label for="description">Description:</label></td>
                <td>
                    <textarea id="description" name="description"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Create Workspace">
                </td>
            </tr>
        </table>
    </form>

    <p><a href="workspaceHome.php">Back</a></p>

</body>
</html>