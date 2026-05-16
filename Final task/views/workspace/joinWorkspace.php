<?php
include __DIR__ . "/../../controllers/joinWorkspaceController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Join Workspace</title>
</head>
<body>

    <h1>Join Workspace</h1>

    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="invite_code">Invite Code:</label></td>
                <td>
                    <input type="text" id="invite_code" name="invite_code" value="<?php echo $invite_code; ?>">
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Join Workspace">
                </td>
            </tr>
        </table>
    </form>

    <p><a href="workspaceHome.php">Back</a></p>

</body>
</html>