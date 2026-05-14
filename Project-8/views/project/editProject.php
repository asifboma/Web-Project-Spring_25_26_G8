<?php
include "../../controllers/editProjectController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
</head>
<body>

    <h1>Project Settings</h1>

    <p>
        <a href="projectDetails.php?id=<?php echo $project_id; ?>">Back to Details</a> |
        <a href="projectList.php">Project List</a>
    </p>

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
                    <?php
                    $colors = [
                        "#3498db" => "Blue",
                        "#2ecc71" => "Green",
                        "#e74c3c" => "Red",
                        "#f39c12" => "Orange",
                        "#9b59b6" => "Purple"
                    ];
                    ?>

                    <?php foreach ($colors as $colorValue => $colorName) { ?>
                        <label>
                            <input type="radio" name="color_label" value="<?php echo $colorValue; ?>"
                                <?php if ($color_label == $colorValue) echo "checked"; ?>>
                            <?php echo $colorName; ?>
                        </label>
                        <br>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td>Project Members:</td>
                <td>
                    <?php while ($member = $workspaceMembers->fetch_assoc()) { ?>
                        <label>
                            <input type="checkbox" name="members[]" value="<?php echo $member['user_id']; ?>"
                                <?php if (in_array($member["user_id"], $selectedMembers)) echo "checked"; ?>>
                            <?php echo $member["name"]; ?>
                        </label>
                        <br>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Update Project">
                </td>
            </tr>
        </table>
    </form>

    <hr>

    <h2>Archive Project</h2>

    <button onclick="archiveProject(<?php echo $project_id; ?>)">Archive This Project</button>

    <script src="../../assets/js/project.js"></script>

</body>
</html>