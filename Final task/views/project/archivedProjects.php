<?php
include __DIR__ . "/../../controllers/archivedProjectsController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Archived Projects</title>
</head>
<body>

    <h1>Archived Projects</h1>

    <p><a href="projectList.php">Back to Active Projects</a></p>

    <?php if ($projects->num_rows == 0) { ?>

        <p>No archived projects found.</p>

    <?php } else { ?>

        <table border="1" cellpadding="8">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Created At</th>
            </tr>

            <?php while ($project = $projects->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $project["name"]; ?></td>
                    <td><?php echo $project["description"]; ?></td>
                    <td><?php echo $project["deadline"]; ?></td>
                    <td><?php echo $project["created_at"]; ?></td>
                </tr>
            <?php } ?>
        </table>

    <?php } ?>

</body>
</html>