<?php
include __DIR__ . "/../../controllers/projectDetailsController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project Details</title>
    <style>
        .badge {
            display: inline-block;
            padding: 8px;
            color: white;
            margin-right: 8px;
        }

        .todo {
            background: gray;
        }

        .progress {
            background: orange;
        }

        .done {
            background: green;
        }
    </style>
</head>
<body>

    <h1><?php echo $project["name"]; ?></h1>

    <p>
        <a href="projectList.php">Project List</a> |
        <a href="editProject.php?id=<?php echo $project_id; ?>">Settings</a> |
        <a href="../task/taskBoard.php?project_id=<?php echo $project_id; ?>">Task Board</a> |
        <a href="../activity/activityFeed.php?project_id=<?php echo $project_id; ?>">Activity Feed</a>
    </p>

    <p><strong>Description:</strong> <?php echo $project["description"]; ?></p>

    <p><strong>Deadline:</strong> <?php echo $project["deadline"]; ?></p>

    <h2>Task Summary</h2>

    <span class="badge todo">
        To Do: <?php echo $summary["todo_count"]; ?>
    </span>

    <span class="badge progress">
        In Progress: <?php echo $summary["progress_count"]; ?>
    </span>

    <span class="badge done">
        Done: <?php echo $summary["done_count"]; ?>
    </span>

    <h2>Project Members</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>Member Name</th>
            <th>Assigned Task Count</th>
        </tr>

        <?php while ($member = $members->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $member["name"]; ?></td>
                <td><?php echo $member["task_count"]; ?></td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>