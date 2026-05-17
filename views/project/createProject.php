<?php
include __DIR__ . "/../../controllers/createProjectController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Project</title>
    <style>
        .color-option {
            display: inline-block;
            margin-right: 12px;
        }
    </style>
</head>
<body>

    <h1>Create Project</h1>

    <p><a href="projectList.php">Back to Project List</a></p>

    <?php
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="name">Project Name:</label></td>
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
                <td><label for="deadline">Deadline:</label></td>
                <td>
                    <input type="date" id="deadline" name="deadline" value="<?php echo $deadline; ?>">
                </td>
            </tr>

            <tr>
                <td>Color Label:</td>
                <td>
                    <label class="color-option">
                        <input type="radio" name="color_label" value="#3498db" checked>
                        Blue
                    </label>

                    <label class="color-option">
                        <input type="radio" name="color_label" value="#2ecc71">
                        Green
                    </label>

                    <label class="color-option">
                        <input type="radio" name="color_label" value="#e74c3c">
                        Red
                    </label>

                    <label class="color-option">
                        <input type="radio" name="color_label" value="#f39c12">
                        Orange
                    </label>

                    <label class="color-option">
                        <input type="radio" name="color_label" value="#9b59b6">
                        Purple
                    </label>
                </td>
            </tr>

            <tr>
                <td>Project Members:</td>
                <td>
                    <?php while ($member = $members->fetch_assoc()) { ?>
                        <label>
                            <input type="checkbox" name="members[]" value="<?php echo $member['user_id']; ?>">
                            <?php echo $member["name"]; ?>
                        </label>
                        <br>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Create Project">
                </td>
            </tr>
        </table>
    </form>

</body>
</html>