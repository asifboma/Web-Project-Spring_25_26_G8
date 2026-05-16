<?php
include __DIR__ . "/../../controllers/projectListController.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project List</title>
    <style>
        .project-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 12px;
            width: 280px;
            display: inline-block;
            vertical-align: top;
        }

        .progress-box {
            width: 100%;
            background: #ddd;
            height: 18px;
        }

        .progress-bar {
            height: 18px;
            background: green;
            color: white;
            text-align: center;
            font-size: 12px;
        }

        .overdue {
            color: red;
            font-weight: bold;
        }

        .avatar {
            display: inline-block;
            background: #222;
            color: white;
            padding: 5px 8px;
            border-radius: 50%;
            margin-right: 3px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<h1>Project List of <?php echo $workspace["name"]; ?></h1>
<p><strong>Invitation Code:</strong><?php echo $workspace["invite_code"]; ?></p>

<p>
    <a href="../workspace/workspaceHome.php">Workspace Home</a> |
    <a href="createProject.php">Create Project</a> |
    <a href="archivedProjects.php">Archived Projects</a> |
    <a href="../../controllers/logoutController.php">Logout</a>
</p>

<?php if ($projects->num_rows == 0) { ?>

    <p>No active projects found.</p>

<?php } else { ?>

    <?php while ($project = $projects->fetch_assoc()) { ?>

        <?php
        $total = $project["total_tasks"];
        $done = $project["done_tasks"];

        if ($total > 0) {
            $progress = round(($done / $total) * 100);
        } else {
            $progress = 0;
        }

        $deadlineClass = "";
        if (!empty($project["deadline"]) && $project["deadline"] < date("Y-m-d")) {
            $deadlineClass = "overdue";
        }

        $members = $projectModel->getProjectMembers($connection, $project['id']);
        ?>

        <div class="project-card" style="border-left: 8px solid <?php echo $project['color_label']; ?>;">

            <h2><?php echo $project["name"]; ?></h2>

            <p><?php echo $project["description"]; ?></p>

            <p class="<?php echo $deadlineClass; ?>">
                Deadline: <?php echo $project["deadline"]; ?>
            </p>

            <p>Members:</p>
            <p>
                <?php if ($members) { ?>
                    <?php while ($member = $members->fetch_assoc()) { ?>
                        <span class="avatar">
                            <?php echo strtoupper(substr($member["name"], 0, 1)); ?>
                        </span>
                    <?php } ?>
                <?php } ?>
            </p>

            <p>Progress:</p>

            <?php if ($total == 0) { ?>
                <p>No tasks yet</p>
            <?php } else { ?>
                <div class="progress-box">
                    <div class="progress-bar" style="width: <?php echo $progress; ?>%;">
                        <?php echo $progress; ?>%
                    </div>
                </div>
            <?php } ?>

            <br>

            <a href="projectDetails.php?id=<?php echo $project['id']; ?>">Details</a> |
            <a href="editProject.php?id=<?php echo $project['id']; ?>">Settings</a> |
            <a href="../task/taskBoard.php?project_id=<?php echo $project['id']; ?>">Task Board</a> |
            <a href="../activity/activityFeed.php?project_id=<?php echo $project['id']; ?>">Activity</a>

        </div>

    <?php } ?>

<?php } ?>

</body>
</html>